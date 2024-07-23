<?php

namespace App\Service\Author;

use App\CQRS\BaseQueryService;
use App\Normalizer\Entity\Normalizer;
use App\Repository\AuthorRepository;

class QueryService extends BaseQueryService
{
    public function __construct(
        AuthorRepository $authorRepository,
        Normalizer $normalizer,
    ) {
        parent::__construct($authorRepository, $normalizer);
    }

    public function getByLastName(string $lastname): array
    {
        return $this->repository->findByLastName($lastname);
    }
}