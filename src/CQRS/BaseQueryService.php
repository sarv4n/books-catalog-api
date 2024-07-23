<?php

namespace App\CQRS;

use App\Entity\EntityInterface;
use App\Normalizer\Entity\EntityNormalizerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;

class BaseQueryService
{
    protected $repository;

    public function __construct(
        ServiceEntityRepositoryInterface $entityRepository,
        protected readonly EntityNormalizerInterface $normalizer,
    ) {
        $this->repository = $entityRepository;
    }

    public function getAll(bool $normalized = false): array
    {
        $items = $this->repository->findAll();

        if (!$normalized) {
            return $items;
        }

        $normalizedItems = [];

        foreach ($items as $item) {
            $normalizedItems[] = $this->normalizer->normalize($item);
        }

        return $normalizedItems;
    }

    public function getItem(int $id, bool $normalized = false): EntityInterface | array | null
    {
        if ($item = $this->repository->findOneBy(['id' => $id])) {
            if (!$normalized) {
                return $item;
            }

            return $this->normalizer->normalize($item);
        }

        return null;
    }
}