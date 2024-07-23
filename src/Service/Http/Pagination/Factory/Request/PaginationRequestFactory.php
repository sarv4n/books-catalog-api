<?php

namespace App\Service\Http\Pagination\Factory\Request;

use App\CQRS\Http\RequestInterface;
use App\Service\Http\Pagination\DTO\Request\PaginationRequest;

class PaginationRequestFactory implements PaginationRequestFactoryInterface
{

    public function create(array $args): RequestInterface
    {
        $dto = new PaginationRequest();

        $dto->setPage($args['page'] ?? $dto->getPage());
        $dto->setLimit($args['limit'] ?? $dto->getLimit());

        return $dto;
    }
}