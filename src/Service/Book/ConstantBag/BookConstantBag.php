<?php

namespace App\Service\Book\ConstantBag;

use App\CQRS\ConstantBagInterface;

readonly class BookConstantBag implements ConstantBagInterface
{
    public const BOOKS_FILES_PATH_SIGNATURE = '%s/';
    public const IMAGE_FILE_NAME_SIGNATURE = 'image.%s';
}