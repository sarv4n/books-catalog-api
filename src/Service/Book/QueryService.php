<?php

namespace App\Service\Book;

use App\CQRS\BaseQueryService;
use App\Normalizer\Entity\Normalizer;
use App\Repository\BookRepository;
use App\Service\Author\QueryService as AuthorQueryService;

class QueryService extends BaseQueryService
{
    public function __construct(
        BookRepository $authorRepository,
        Normalizer $normalizer,
        private readonly AuthorQueryService $authorQueryService,
    ) {
        parent::__construct($authorRepository, $normalizer);
    }

    public function getByAuthorLastname(string $lastname, bool $normalized = false): array
    {
        $authors = $this->authorQueryService->getByLastName($lastname);
        $books = [];
        $uniqueBookIds = [];

        foreach ($authors as $author) {
            foreach ($author->getBooks() as $book) {
                $bookId = $book->getId();

                if (!in_array($bookId, $uniqueBookIds, true)) {
                    $uniqueBookIds[] = $bookId;

                    if ($normalized) {
                        $books[] = $this->normalizer->normalize($book);
                    } else {
                        $books[] = $book;
                    }
                }
            }
        }

        return $books;
    }
}