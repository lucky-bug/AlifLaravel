<?php

namespace App\Http\Services;

class FileIOService
{

    public function readFromFile(string $filename): string
    {
        return file_get_contents($filename);
    }
}
