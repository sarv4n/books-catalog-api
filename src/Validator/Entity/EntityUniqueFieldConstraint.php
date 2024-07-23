<?php

namespace App\Validator\Entity;

use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class EntityUniqueFieldConstraint extends Constraint
{
    public string $message = '{{ entity }} with "{{ field }}" value "{{ value }}" already exists.';

    #[HasNamedArguments]
    public function __construct(
        public string $entity,
        public array $fields,
        public bool $excludeSelf = false,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct([], $groups, $payload);
    }

    public function getTargets(): array|string
    {
        return self::CLASS_CONSTRAINT;
    }
}
