<?php

namespace App\Service\Book;

use App\Entity\Book;
use App\Service\Book\ConstantBag\BookConstantBag;
use App\Service\Common\FileSystem\FileSystemService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BookImageService extends FileSystemService
{
    public function __construct(
        private readonly ParameterBagInterface $parameterBag,
    )
    {
    }

    public function saveFile(Book $book, UploadedFile $file): string
    {
        $uploadDir = $this->parameterBag->get('books_files_path').
            sprintf(BookConstantBag::BOOKS_FILES_PATH_SIGNATURE, $book->getId());
        $filename = sprintf(BookConstantBag::IMAGE_FILE_NAME_SIGNATURE, $file->guessExtension());

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $file->move($uploadDir, $filename);

        return $uploadDir.$filename;
    }
}