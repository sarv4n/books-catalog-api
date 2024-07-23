<?php

namespace App\Controller;

use App\Service\Book\CommandService;
use App\Service\Book\Factory\Command\CreateCommandFactory;
use App\Service\Book\Factory\Command\UpdateCommandFactory;
use App\Service\Book\Factory\Request\CreateRequestFactory;
use App\Service\Book\Factory\Request\UpdateRequestFactory;
use App\Service\Book\QueryService;
use App\Service\Common\Validator\ValidatorService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/book')]
class BookController extends RestController
{
    #[Route('/list', name: 'books_list', methods: ['GET'])]
    public function listAction(
        QueryService         $queryService,
    ) {
        return $this->makeJsonResponse($queryService->getAll(true));
    }

    #[Route('/create', name: 'create_book', methods: ['POST'])]
    public function createAction(
        Request              $request,
        CreateRequestFactory $createRequestFactory,
        CreateCommandFactory $commandFactory,
        ValidatorService     $validator,
        CommandService       $commandService,
    ) {
        $dto = $createRequestFactory->create($request->toArray());
        $validator->validateWithThrowsException($dto);

        $commandService->create($commandFactory->create($dto));
        return $this->makeJsonResponse(['ok']);
    }

    #[Route('/update', name: 'update_book', methods: ['POST'])]
    public function updateAction(
        Request              $request,
        UpdateRequestFactory $updateRequestFactory,
        UpdateCommandFactory $commandFactory,
        ValidatorService     $validator,
        CommandService       $commandService,
    ) {
        $dto = $updateRequestFactory->create($request->toArray());
        $validator->validateWithThrowsException($dto);

        $commandService->update($commandFactory->create($dto));

        return $this->makeJsonResponse(['ok']);
    }

    #[Route('/find-by/id/{id}', name: 'find_book', methods: ['GET'])]
    public function findByIdAction(
        int $id,
        QueryService       $queryService,
    ) {
        return $this->makeJsonResponse($queryService->getItem($id, true));
    }

    #[Route('/find-by/lastname/{lastname}', name: 'find_by_lastname', methods: ['GET'])]
    public function findByLastNameAction(
        string $lastname,
        QueryService       $queryService,
    ) {
        return $this->makeJsonResponse($queryService->getByAuthorLastname($lastname, true));
    }
}