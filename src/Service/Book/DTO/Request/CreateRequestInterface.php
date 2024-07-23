<?php

namespace App\Service\Book\DTO\Request;

use App\CQRS\Http\RequestInterface;

interface CreateRequestInterface extends RequestInterface
{
    public function getTitle(): mixed;
    public function setTitle(mixed $title): void;

    public function getDescription(): mixed;
    public function setDescription(mixed $description): void;

    public function getImageFile(): mixed;
    public function setImageFile(mixed $imageFile): void;

    public function getPublicationDate(): mixed;
    public function setPublicationDate(mixed $publicationDate): void;

    public function getAuthors(): mixed;
    public function setAuthors(mixed $authors): void;
}
