<?php

namespace App\Validator\Entity;

use App\Entity\EntityInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class EntityUniqueFieldConstraintValidator extends ConstraintValidator
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!$constraint instanceof EntityUniqueFieldConstraint) {
            throw new UnexpectedTypeException($constraint, EntityUniqueFieldConstraint::class);
        }

        $entityReflectionClass = new \ReflectionClass($constraint->entity);

        if (!$entityReflectionClass->implementsInterface(EntityInterface::class)) {
            throw new UnexpectedTypeException($constraint->entity, EntityInterface::class);
        }

        $repository = $this->entityManager->getRepository($constraint->entity);

        foreach ($constraint->fields as $fieldName) {
            $record = $repository->findOneBy([$fieldName => $value->{'get' . ucfirst($fieldName)}()]);

            if ($record && $constraint->excludeSelf && $record->getId() === $value->getId()) {
                continue;
            }

            if ($record !== null) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ entity }}', $constraint->entity)
                    ->setParameter('{{ field }}', $fieldName)
                    ->setParameter('{{ value }}', $value->{'get' . ucfirst($fieldName)}())
                    ->addViolation();
            }
        }

    }
}
