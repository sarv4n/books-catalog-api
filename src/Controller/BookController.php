<?php

namespace App\Controller;

use App\Exception\Validator\ValidationException;
use App\Service\Book\CommandService;
use App\Service\Book\Factory\Command\CreateCommandFactory;
use App\Service\Book\Factory\Command\UpdateCommandFactory;
use App\Service\Book\Factory\Request\CreateRequestFactory;
use App\Service\Book\Factory\Request\UpdateRequestFactory;
use App\Service\Book\QueryService;
use App\Service\Common\Validator\ValidatorService;
use App\Service\Http\Pagination\Factory\Request\PaginationRequestFactory;
use Doctrine\ORM\EntityNotFoundException;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/book')]
class BookController extends RestController
{
    #[Route('/list', name: 'books_list', methods: ['GET'])]
    public function listAction(
        Request $request,
        QueryService $queryService,
        PaginatorInterface $paginator,
        PaginationRequestFactory $paginationRequestFactory,
    ) {
        $dto = $paginationRequestFactory->create($request->query->all());

        return $this->makeJsonResponse(
            $paginator->paginate(
                $queryService->getAll(true),
                $dto->getPage(),
                $dto->getLimit(),
            ),
        );
    }

    #[Route('/create', name: 'create_book', methods: ['POST'])]
    public function createAction(
        Request $request,
        CreateRequestFactory $createRequestFactory,
        CreateCommandFactory $commandFactory,
        ValidatorService $validator,
        CommandService $commandService,
    ) {
        $requestData = $request->request->all();
        $requestData['imageFile'] = $request->files->get('imageFile');

        $dto = $createRequestFactory->create($requestData);

        try {
            $validator->validateWithThrowsException($dto);
        } catch (ValidationException $exception) {
            return $this->makeJsonErrorResponse($exception->getMessage());
        }

        $commandService->create($commandFactory->create($dto));
        return $this->makeJsonResponse(['ok']);
    }

    #[Route('/update', name: 'update_book', methods: ['POST'])]
    public function updateAction(
        Request $request,
        UpdateRequestFactory $updateRequestFactory,
        UpdateCommandFactory $commandFactory,
        ValidatorService $validator,
        CommandService $commandService,
    ) {
        $requestData = $request->request->all();
        $requestData['imageFile'] = $request->files->get('imageFile');

        $dto = $updateRequestFactory->create($requestData);

        try {
            $validator->validateWithThrowsException($dto);
            $commandService->update($commandFactory->create($dto));
        } catch (ValidationException $exception) {
            return $this->makeJsonErrorResponse($exception->getMessage());
        } catch (EntityNotFoundException $e) {
            return $this->makeJsonResponse(['error' => $e->getMessage()]);
        }

        return $this->makeJsonResponse(['ok']);
    }

    #[Route('/find/{id}', name: 'find_book', methods: ['GET'])]
    public function findByIdAction(
        int $id,
        QueryService $queryService,
    ) {
        return $this->makeJsonResponse($queryService->getItem($id, true));
    }

    #[Route('/find-by/lastname/{lastname}', name: 'find_by_lastname', methods: ['GET'])]
    public function findByLastNameAction(
        string $lastname,
        Request $request,
        QueryService $queryService,
        PaginatorInterface $paginator,
        PaginationRequestFactory $paginationRequestFactory,
    ) {
        $dto = $paginationRequestFactory->create($request->query->all());

        return $this->makeJsonResponse(
            $paginator->paginate(
                $queryService->getByAuthorLastname($lastname, true),
                $dto->getPage(),
                $dto->getLimit(),
            ),
        );
    }
}