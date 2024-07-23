<?php

namespace App\Service\Book\Factory\Request;

use App\CQRS\Http\RequestFactoryInterface;
use App\Service\Book\BookImageService;
use App\Service\Book\DTO\Request\CreateRequest;
use App\Service\Book\DTO\Request\CreateRequestInterface;

class CreateRequestFactory implements RequestFactoryInterface
{
    public function create(array $args): CreateRequestInterface
    {
        $dto = new CreateRequest();

        $dto->setTitle($args['title'] ?? null);
        $dto->setDescription($args['description'] ?? null);
        $dto->setImageFile($args['imageFile'] ?? null);
        $dto->setPublicationDate($args['publicationDate'] ?? null);
        $dto->setAuthors($args['authors'] ?? null);

        return $dto;
    }
}
