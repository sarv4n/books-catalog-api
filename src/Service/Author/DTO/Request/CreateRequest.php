<?php

namespace App\Service\Author\DTO\Request;

use App\Entity\Book;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Entity as EntityAssert;

class CreateRequest implements CreateRequestInterface
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(min: 3, max: 255)]
    private mixed $firstName = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(min: 3, max: 255)]
    private mixed $lastName = null;

    #[Assert\Type('string')]
    private mixed $patronymic = null;

    #[Assert\Type('array')]
    #[EntityAssert\EntityArrayConstraint(entity: Book::class)]
    private mixed $books = null;

    public function getFirstName(): mixed
    {
        return $this->firstName;
    }

    public function setFirstName(mixed $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): mixed
    {
        return $this->lastName;
    }

    public function setLastName(mixed $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPatronymic(): mixed
    {
        return $this->patronymic;
    }

    public function setPatronymic(mixed $patronymic): void
    {
        $this->patronymic = $patronymic;
    }

    public function getBooks(): mixed
    {
        return $this->books;
    }

    public function setBooks(mixed $books): void
    {
        $this->books = $books;
    }
}