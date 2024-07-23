<?php

namespace App\Service\Author;

use App\Entity\Author;
use App\Service\Author\DTO\Command\CreateCommandInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Book\QueryService as BookQueryService;

class CommandService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly BookQueryService $bookQueryService,
    )
    {
    }

    public function create(CreateCommandInterface $command): void
    {
        $author = new Author();

        $author->setFirstName($command->getFirstName());
        $author->setLastName($command->getLastName());
        $author->setPatronymic($command->getPatronymic());

        foreach ($command->getBooks() as $bookId) {
            $author->addBook($this->bookQueryService->getItem($bookId));
        }

        $this->entityManager->persist($author);
        $this->entityManager->flush();
    }
}
