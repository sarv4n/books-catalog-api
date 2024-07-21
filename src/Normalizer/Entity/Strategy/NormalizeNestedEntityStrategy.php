<?php

namespace App\Normalizer\Entity\Strategy;

use App\Normalizer\Entity\Normalizer;
use App\Service\Normalizer\Entity\EntityNormalizerService;

class NormalizeNestedEntityStrategy implements NormalizeEntityStrategyInterface
{
    private ?Normalizer $normalizer = null;

    public function __construct(
        private readonly EntityNormalizerService $service,
    ) {
    }

    public function setNormalizer(Normalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function apply($object, $format = null, array $context = []): array
    {
        $normalizedData = [];
        $baseEntity = new \ReflectionClass(get_parent_class($object));

        foreach ($baseEntity->getProperties() as $property) {
            $propertyName = $property->getName();
            $value = $this->service->getPropertyValue($object, $propertyName);

            if (is_object($value) && $this->service->isLazyObjectStateEntity($value)) {
                $normalizedData[$propertyName] = $this->normalizer->normalize($value, $format, $context);
            } else {
                if ($this->service->isBuiltInType($value)) {
                    $normalizedData[$propertyName] = $value;
                }
            }
        }

        return $normalizedData;
    }
}