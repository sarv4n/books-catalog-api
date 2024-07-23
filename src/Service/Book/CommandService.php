<?php

namespace App\Service\Book;

use App\Entity\Book;
use App\Service\Book\DTO\Command\CreateCommandInterface;
use App\Service\Book\DTO\Command\UpdateCommandInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Author\QueryService as AuthorQueryService;
use Doctrine\ORM\EntityNotFoundException;

class CommandService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly AuthorQueryService $authorQueryService,
        private readonly QueryService $queryService,
        private readonly BookImageService $imageService,
    ) {
    }

    public function create(CreateCommandInterface $command): void
    {
        $book = new Book();

        $book->setTitle($command->getTitle());
        $book->setDescription($command->getDescription());
        $book->setPublicationDate($command->getPublicationDate());

        foreach ($command->getAuthors() as $authorId) {
            $book->addAuthor($this->authorQueryService->getItem($authorId));
        }

        $this->entityManager->persist($book);

        $imagePath = $this->imageService->saveFile($book, $command->getImageFile());
        $book->setImagePath($imagePath);

        $this->entityManager->flush();
    }

    /*
     * @throws EntityNotFoundException
     */
    public function update(UpdateCommandInterface $command): void
    {
        $book = $this->queryService->getItem($command->getId());

        if ($book === null) {
            throw new EntityNotFoundException();
        }

        $book->setTitle($command->getTitle());
        $book->setDescription($command->getDescription());

        if ($command->getPublicationDate() !== null) {
            $book->setPublicationDate($command->getPublicationDate());
        }

        foreach ($command->getAuthors() as $authorId) {
            $book->addAuthor($this->authorQueryService->getItem($authorId));
        }

        $this->entityManager->persist($book);

        if ($command->getImageFile() !== null) {
            $imagePath = $this->imageService->saveFile($book, $command->getImageFile());
            $book->setImagePath($imagePath);
        }

        $this->entityManager->flush();
    }
}
