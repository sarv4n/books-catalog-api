<?php

namespace App\Service\Book\DTO\Command;

class UpdateCommand implements UpdateCommandInterface
{
    private int $id;

    private string $title;

    private ?string $description;

    private ?string $imagePath;

    private ?\DateTimeImmutable $publicationDate;

    private ?array $authors;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

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

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function getPublicationDate(): ?\DateTimeImmutable
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?\DateTimeImmutable $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    public function getAuthors(): ?array
    {
        return $this->authors;
    }

    public function setAuthors(?array $authors): void
    {
        $this->authors = $authors;
    }
}