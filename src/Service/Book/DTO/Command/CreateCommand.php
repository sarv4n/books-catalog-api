<?php

namespace App\Service\Book\DTO\Command;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateCommand implements CreateCommandInterface
{
    private string $title;

    private ?string $description;

    private UploadedFile $imageFile;

    private \DateTimeImmutable $publicationDate;

    private ?array $authors;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImageFile(): UploadedFile
    {
        return $this->imageFile;
    }

    public function setImageFile(UploadedFile $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    public function getPublicationDate(): \DateTimeImmutable
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeImmutable $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function setAuthors(array $authors): void
    {
        $this->authors = $authors;
    }

}