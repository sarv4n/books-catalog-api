<?php

namespace App\Controller;

use App\Exception\Validator\ValidationException;
use App\Service\Author\CommandService;
use App\Service\Author\Factory\Command\CreateCommandFactory;
use App\Service\Author\Factory\Request\CreateRequestFactory;
use App\Service\Author\QueryService;
use App\Service\Common\Validator\ValidatorService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/author')]
class AuthorController extends RestController
{
    #[Route('/list', name: 'authors_list', methods: ['GET'])]
    public function listAction(
        QueryService $queryService,
    ) {
        return $this->makeJsonResponse($queryService->getAll(true));
    }

    #[Route('/create', name: 'create_author', methods: ['POST'])]
    public function createAction(
        Request $request,
        CreateRequestFactory $createRequestFactory,
        CreateCommandFactory $commandFactory,
        ValidatorService $validator,
        CommandService $commandService,
    ) {
        $dto = $createRequestFactory->create($request->request->all());

        try {
            $validator->validateWithThrowsException($dto);
        } catch (ValidationException $exception) {
            return $this->makeJsonErrorResponse($exception->getMessage());
        }

        $commandService->create($commandFactory->create($dto));
        return $this->makeJsonResponse(['ok']);
    }
}