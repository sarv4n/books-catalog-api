<?php

namespace App\Normalizer\Entity\Strategy;

use App\Normalizer\Entity\Normalizer;
use App\Service\Normalizer\Entity\EntityNormalizerService;

class NormalizeEntityStrategy implements NormalizeEntityStrategyInterface
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
        $reflection = new \ReflectionClass($object);

        foreach ($reflection->getProperties() as $property) {
            $value = $property->getValue($object);
            $propertyName = $property->getName();
            $propertyType = $property->getType();

            if (is_object($value) && $this->service->isLazyObjectStateEntity($value)) {
                $normalizedData[$propertyName] = $this->normalizer->normalize($value, $format, $context);
            } elseif ($propertyType) {
                $isBuiltIn = null;

                if ($propertyType instanceof \ReflectionUnionType) {
                    $typesToCheck = $propertyType->getTypes();
                    foreach ($typesToCheck as $type) {
                        if ($type->isBuiltin() === false) {
                            $isBuiltIn = false;
                            break;
                        }
                    }
                } elseif ($propertyType instanceof \ReflectionType) {
                    $isBuiltIn = $propertyType->isBuiltin();
                }

                if ($isBuiltIn) {
                    $normalizedData[$propertyName] = $value;
                }
            }
        }

        return $normalizedData;
    }
}