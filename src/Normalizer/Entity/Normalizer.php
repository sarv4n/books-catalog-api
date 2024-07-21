<?php

namespace App\Normalizer\Entity;

use App\Normalizer\Entity\Strategy\NormalizeEntityStrategy;
use App\Normalizer\Entity\Strategy\NormalizeNestedEntityStrategy;
use App\Service\Normalizer\Entity\EntityNormalizerService;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class Normalizer implements NormalizerInterface
{
    public function __construct(
        private readonly NormalizeEntityStrategy $normalizeEntityStrategy,
        private readonly NormalizeNestedEntityStrategy $normalizeNestedEntityStrategy,
        private readonly EntityNormalizerService $service,
    ) {
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $strategy = $this->service->isLazyObjectStateEntity($object) ?
            $this->normalizeNestedEntityStrategy : $this->normalizeEntityStrategy;

        $strategy->setNormalizer($this);

        return $strategy->apply($object);
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data);
    }

    public function getSupportedTypes(?string $format): array
    {
        return [];
    }
}