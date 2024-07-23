<?php

namespace App\Service\Author\Factory\Request;

use App\CQRS\Http\RequestFactoryInterface;
use App\Service\Author\DTO\Request\CreateRequest;
use App\Service\Author\DTO\Request\CreateRequestInterface;

class CreateRequestFactory implements RequestFactoryInterface
{
    public function create(array $args): CreateRequestInterface
    {
        $dto = new CreateRequest();

        $dto->setFirstName($args['firstName'] ?? null);
        $dto->setLastName($args['lastName'] ?? null);
        $dto->setPatronymic($args['patronymic'] ?? null);
        $dto->setBooks($args['books'] ?? null);

        return $dto;
    }
}