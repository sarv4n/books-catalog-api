<?php

namespace App\Service\Book\Factory\Command;

use App\CQRS\CommandFactoryInterface;
use App\Service\Book\DTO\Command\UpdateCommand;
use App\Service\Book\DTO\Command\UpdateCommandInterface;
use App\Service\Book\DTO\Request\UpdateRequestInterface;

class UpdateCommandFactory implements CommandFactoryInterface
{
    public function create(UpdateRequestInterface $request): UpdateCommandInterface
    {
        $command = new UpdateCommand();

        $command->setId($request->getId());
        $command->setTitle($request->getTitle());
        $command->setDescription($request->getDescription());
        $command->setImageFile($request->getImageFile());

        $command->setPublicationDate(
            $request->getPublicationDate() ?
                new \DateTimeImmutable($request->getPublicationDate()) : null,
        );

        $command->setAuthorsToAdd($request->getAuthorsToAdd() ?? []);
        $command->setAuthorsToRemove($request->getAuthorsToRemove() ?? []);

        return $command;
    }
}
