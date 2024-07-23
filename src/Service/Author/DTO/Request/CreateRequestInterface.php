<?php

namespace App\Service\Author\DTO\Request;

use App\CQRS\Http\RequestInterface;

interface CreateRequestInterface extends RequestInterface
{
    public function getFirstName(): mixed;

    public function setFirstName(mixed $firstName): void;

    public function getLastName(): mixed;

    public function setLastName(mixed $lastName): void;

    public function getPatronymic(): mixed;

    public function setPatronymic(mixed $patronymic): void;

    public function getBooks(): mixed;

    public function setBooks(mixed $books): void;
}
