<?php

namespace App\Service\Book\DTO\Command;

use App\CQRS\CommandInterface;

interface UpdateCommandInterface extends CommandInterface
{
    public function getId(): int;
    public function setId(int $id): void;

    public function getTitle(): string;
    public function setTitle(string $title): void;

    public function getDescription(): ?string;
    public function setDescription(?string $description): void;

    public function getImagePath(): ?string;
    public function setImagePath(?string $imagePath): void;

    public function getPublicationDate(): ?\DateTimeImmutable;
    public function setPublicationDate(?\DateTimeImmutable $publicationDate): void;

    public function getAuthors(): ?array;
    public function setAuthors(?array $authors): void;
}
