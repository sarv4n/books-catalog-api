<?php

namespace App\Service\Book;

use App\Entity\Book;
use App\Service\Book\DTO\Command\CreateCommandInterface;
use App\Service\Book\DTO\Command\UpdateCommandInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Author\QueryService as AuthorQueryService;

class CommandService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly AuthorQueryService $authorQueryService,
        private readonly QueryService $queryService,
    )
    {
    }

    public function create(CreateCommandInterface $command): void
    {
        $book = new Book();

        $book->setTitle($command->getTitle());
        $book->setDescription($command->getDescription());
        $book->setImagePath($command->getImagePath());
        $book->setPublicationDate($command->getPublicationDate());

        foreach ($command->getAuthors() as $authorId) {
            $book->addAuthor($this->authorQueryService->getItem($authorId));
        }

        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    public function update(UpdateCommandInterface $command): void
    {
        $book = $this->queryService->getItem($command->getId());

        $book->setTitle($command->getTitle());
        $book->setDescription($command->getDescription());
        $book->setImagePath($command->getImagePath());

        if ($command->getPublicationDate() !== null) {
            $book->setPublicationDate($command->getPublicationDate());
        }

        foreach ($command->getAuthors() as $authorId) {
            $book->addAuthor($this->authorQueryService->getItem($authorId));
        }

        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }
}
