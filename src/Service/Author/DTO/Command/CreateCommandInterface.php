<?php

namespace App\Service\Author\DTO\Command;

use App\CQRS\CommandInterface;

interface CreateCommandInterface extends CommandInterface
{
    public function getFirstName(): string;

    public function setFirstName(string $firstName): void;

    public function getLastName(): string;

    public function setLastName(string $lastName): void;

    public function getPatronymic(): ?string;

    public function setPatronymic(?string $patronymic): void;

    public function getBooks(): array;

    public function setBooks(array $books): void;
}
