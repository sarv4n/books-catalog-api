<?php

namespace App\Normalizer\Entity\Strategy;

interface NormalizeEntityStrategyInterface
{
    public function apply($object, $format = null, array $context = []): array;
}