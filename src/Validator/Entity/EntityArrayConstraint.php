<?php

namespace App\Validator\Entity;

use App\Entity\EntityInterface;
use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class EntityArrayConstraint extends Constraint
{
    public string $message = '{{ entity }} with following IDs are not found: {{ bookIds }}';
    #[HasNamedArguments]
    public function __construct(
        public string $entity,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct([], $groups, $payload);
    }
}