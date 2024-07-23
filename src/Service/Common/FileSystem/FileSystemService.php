<?php

namespace App\Service\Common\FileSystem;

class FileSystemService
{
    public function fileExists(string $path): bool
    {
        return file_exists($path);
    }
}