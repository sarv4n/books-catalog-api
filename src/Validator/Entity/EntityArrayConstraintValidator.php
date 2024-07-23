<?php

namespace App\Validator\Entity;

use App\Entity\EntityInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class EntityArrayConstraintValidator extends ConstraintValidator
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (empty($value)) {
            return;
        }

        if (!$constraint instanceof EntityArrayConstraint) {
            throw new UnexpectedTypeException($constraint, EntityArrayConstraint::class);
        }

        if (!is_array($value)) {
            throw new UnexpectedTypeException($value, 'array');
        }

        foreach ($value as &$entityId) {
            $entityId = (int) $entityId;
            if (!is_int($entityId)) {
                throw new UnexpectedTypeException($entityId, 'int');
            }
        }

        $entityReflectionClass = new \ReflectionClass($constraint->entity);

        if (!$entityReflectionClass->implementsInterface(EntityInterface::class)) {
            throw new UnexpectedTypeException($constraint->entity, EntityInterface::class);
        }

        $repository = $this->entityManager->getRepository($constraint->entity);

        $records = $repository->findBy(['id' => $value]);

        $existingIds = array_map(function ($record) {
            return $record->getId();
        }, $records);

        $nonExistingIds = array_diff($value, $existingIds);

        if (!empty($nonExistingIds)) {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('{{ entity }}', $constraint->entity)
                          ->setParameter('{{ entityIds }}', join(', ', $nonExistingIds))
                          ->addViolation()
            ;
        }
    }
}