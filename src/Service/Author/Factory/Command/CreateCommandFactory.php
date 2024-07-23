<?php

namespace App\Service\Author\Factory\Command;

use App\CQRS\CommandFactoryInterface;
use App\Service\Author\DTO\Command\CreateCommand;
use App\Service\Author\DTO\Command\CreateCommandInterface;
use App\Service\Author\DTO\Request\CreateRequestInterface;

class CreateCommandFactory implements CommandFactoryInterface
{
    public function create(CreateRequestInterface $request): CreateCommandInterface
    {
        $command = new CreateCommand();

        $command->setFirstName($request->getFirstName());
        $command->setLastName($request->getLastName());
        $command->setPatronymic($request->getPatronymic());
        $command->setBooks($request->getBooks() ?? []);

        return $command;
    }
}