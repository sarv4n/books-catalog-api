<?php

namespace App\Service\Book\DTO\Command;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UpdateCommand implements UpdateCommandInterface
{
    private int $id;

    private ?string $title;

    private ?string $description;

    private ?UploadedFile $imageFile;

    private ?\DateTimeImmutable $publicationDate;

    private ?array $authorsToAdd;

    private ?array $authorsToRemove;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
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

    public function getImageFile(): ?UploadedFile
    {
        return $this->imageFile;
    }

    public function setImageFile(?UploadedFile $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    public function getPublicationDate(): ?\DateTimeImmutable
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?\DateTimeImmutable $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    public function getAuthorsToAdd(): ?array
    {
        return $this->authorsToAdd;
    }

    public function setAuthorsToAdd(?array $authorsToAdd): void
    {
        $this->authorsToAdd = $authorsToAdd;
    }

    public function getAuthorsToRemove(): ?array
    {
        return $this->authorsToRemove;
    }

    public function setAuthorsToRemove(?array $authorsToRemove): void
    {
        $this->authorsToRemove = $authorsToRemove;
    }
}