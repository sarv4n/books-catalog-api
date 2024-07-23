<?php

namespace App\Service\Http\Pagination\DTO\Request;

use App\CQRS\Http\RequestInterface;

interface PaginationRequestInterface extends RequestInterface
{
    public function getPage(): mixed;

    public function setPage(mixed $page): void;

    public function getLimit(): mixed;

    public function setLimit(mixed $limit): void;
}