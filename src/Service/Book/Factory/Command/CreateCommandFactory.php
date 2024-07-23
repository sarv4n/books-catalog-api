<?php

namespace App\Service\Book\Factory\Command;

use App\CQRS\CommandFactoryInterface;
use App\Service\Book\DTO\Command\CreateCommand;
use App\Service\Book\DTO\Command\CreateCommandInterface;
use App\Service\Book\DTO\Request\CreateRequestInterface;

class CreateCommandFactory implements CommandFactoryInterface
{
    public function create(CreateRequestInterface $request): CreateCommandInterface
    {
        $command = new CreateCommand();

        $command->setTitle($request->getTitle());
        $command->setDescription($request->getDescription());
        $command->setImageFile($request->getImageFile());

        $command->setPublicationDate(
            $request->getPublicationDate() ?
                new \DateTimeImmutable($request->getPublicationDate()) : null,
        );

        $command->setAuthors($request->getAuthors() ?? []);

        return $command;
    }
}
