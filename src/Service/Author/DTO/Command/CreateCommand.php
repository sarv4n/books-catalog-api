<?php

namespace App\Service\Author\DTO\Command;

class CreateCommand implements CreateCommandInterface
{
    private string $firstName;

    private string $lastName;

    private ?string $patronymic;

    private ?array $books;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(?string $patronymic): void
    {
        $this->patronymic = $patronymic;
    }

    public function getBooks(): array
    {
        return $this->books;
    }

    public function setBooks(array $books): void
    {
        $this->books = $books;
    }
}