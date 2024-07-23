<?php

namespace App\Service\Book\Factory\Request;

use App\CQRS\Http\RequestFactoryInterface;
use App\Service\Book\DTO\Request\UpdateRequest;
use App\Service\Book\DTO\Request\UpdateRequestInterface;

class UpdateRequestFactory implements RequestFactoryInterface
{
    public function create(array $args): UpdateRequestInterface
    {
        $dto = new UpdateRequest();

        $dto->setId((int) $args['id'] ?? null);
        $dto->setTitle($args['title'] ?? null);
        $dto->setDescription($args['description'] ?? null);
        $dto->setImageFile($args['imageFile'] ?? null);
        $dto->setPublicationDate($args['publicationDate'] ?? null);
        $dto->setAuthors($args['authors'] ?? null);

        return $dto;
    }
}
