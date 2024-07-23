<?php

namespace App\Service\Book\DTO\Request;

use App\Entity\Book;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Entity as EntityAssert;
use App\Entity\Author;

#[EntityAssert\EntityUniqueFieldConstraint(entity: Book::class, fields: ['title'], excludeSelf: true)]
class UpdateRequest implements UpdateRequestInterface
{
    #[Assert\NotBlank]
    #[Assert\Type('int')]
    private mixed $id = null;

    #[Assert\Type('string')]
    #[Assert\Length(min: 1, max: 255)]
    private mixed $title = null;

    #[Assert\Type('string')]
    #[Assert\Length(min: 1, max: 255)]
    private mixed $description = null;

    #[Assert\Type(UploadedFile::class)]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: ['image/jpeg', 'image/png'],
        mimeTypesMessage: 'Please upload a valid image (JPEG or PNG).'
    )]
    private mixed $imageFile = null;

    #[Assert\DateTime]
    private mixed $publicationDate = null;

    #[Assert\Type('array')]
    #[EntityAssert\EntityArrayConstraint(entity: Author::class)]
    private mixed $authorsToAdd = null;

    #[Assert\Type('array')]
    #[EntityAssert\EntityArrayConstraint(entity: Author::class)]
    private mixed $authorsToRemove = null;

    public function getId(): mixed
    {
        return $this->id;
    }

    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): mixed
    {
        return $this->title;
    }

    public function setTitle(mixed $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): mixed
    {
        return $this->description;
    }

    public function setDescription(mixed $description): void
    {
        $this->description = $description;
    }

    public function getImageFile(): mixed
    {
        return $this->imageFile;
    }

    public function setImageFile(mixed $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    public function getPublicationDate(): mixed
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(mixed $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    public function getAuthorsToAdd(): mixed
    {
        return $this->authorsToAdd;
    }

    public function setAuthorsToAdd(mixed $authorsToAdd): void
    {
        $this->authorsToAdd = $authorsToAdd;
    }

    public function getAuthorsToRemove(): mixed
    {
        return $this->authorsToRemove;
    }

    public function setAuthorsToRemove(mixed $authorsToRemove): void
    {
        $this->authorsToRemove = $authorsToRemove;
    }
}
