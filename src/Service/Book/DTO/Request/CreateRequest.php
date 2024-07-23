<?php

namespace App\Service\Book\DTO\Request;

use App\Entity\Book;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Entity as EntityAssert;
use App\Entity\Author;

#[EntityAssert\EntityUniqueFieldConstraint(entity: Book::class, fields: ['title'])]
class CreateRequest implements CreateRequestInterface
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(min: 1, max: 255)]
    private mixed $title = null;

    #[Assert\Type('string')]
    #[Assert\Length(max: 255)]
    private mixed $description = null;

    #[Assert\NotBlank]
    #[Assert\Type(UploadedFile::class)]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: ['image/jpeg', 'image/png'],
        mimeTypesMessage: 'Please upload a valid image (JPEG or PNG).'
    )]
    private mixed $imageFile = null;

    #[Assert\NotBlank]
    #[Assert\DateTime]
    private mixed $publicationDate = null;

    #[Assert\Type('array')]
    #[EntityAssert\EntityArrayConstraint(entity: Author::class)]
    private mixed $authors = null;

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

    public function getImagePath(): mixed
    {
        return $this->imagePath;
    }

    public function setImagePath(mixed $imagePath): void
    {
        $this->imagePath = $imagePath;
    }


    public function getPublicationDate(): mixed
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(mixed $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    public function getAuthors(): mixed
    {
        return $this->authors;
    }

    public function setAuthors(mixed $authors): void
    {
        $this->authors = $authors;
    }
}
