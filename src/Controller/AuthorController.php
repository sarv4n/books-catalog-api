<?php

namespace App\Controller;

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
    #[Route('/create', name: 'create_author', methods: ['POST'])]
    public function createAction(
        Request              $request,
        CreateRequestFactory $createAuthorRequestFactory,
        CreateCommandFactory $commandFactory,
        ValidatorService     $validator,
        CommandService         $commandService,
    ) {
        $dto = $createAuthorRequestFactory->create($request->toArray());
        $validator->validateWithThrowsException($dto);

        $result = $commandService->create($commandFactory->create($dto));
        dd('Перемога!');
    }

    #[Route('/list', name: 'authors_list', methods: ['GET'])]
    public function listAction(
        Request              $request,
        QueryService         $queryService,
    ) {

        dump($queryService->getAll());
        dd('Перемога!');
    }
}