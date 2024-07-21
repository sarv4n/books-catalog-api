<?php

namespace App\Service\Normalizer\Entity;

use App\Expection\Normalizer\Entity\GetMethodException;
use Doctrine\Persistence\Proxy;

class EntityNormalizerService
{
    public function isLazyObjectStateEntity(object $object): bool
    {
        if ($object instanceof Proxy) {
            return strpos(get_class($object), 'App\\Entity');
        }

        return false;
    }

    public function isBuiltInType($value): bool
    {
        return !is_null($value) && !is_object($value);
    }

    /**
     * @throws GetMethodException
     */
    public function getPropertyValue($object, string $propertyName)
    {
        $getterMethod = 'get' . ucfirst($propertyName);

        if (method_exists($object, $getterMethod)) {
            return $object->$getterMethod();
        } else {
            throw new GetMethodException();
        }
    }
}