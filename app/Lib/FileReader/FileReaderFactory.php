<?php

namespace App\Lib\FileReader;

use App\Lib\FileReader\Readers\CsvReader;
use App\Lib\FileReader\Interfaces\FileReaderInterface;
use App\Lib\FileReader\Exceptions\UnsupportedFileException;
use App\Lib\FileReader\Exceptions\FileNotFoundException;
use App\Lib\FileReader\Exceptions\FileNotReadableException;

abstract class FileReaderFactory
{
    /**
     * Расширение CSV файлов.
     */
    const CSV = 'csv';

    /**
     * @param string $pathToFile
     * @param string $extension
     * @param array $params
     *
     * @throws FileNotFoundException
     * @throws FileNotReadableException
     * @throws UnsupportedFileException
     *
     * @return FileReaderInterface
     */
    public static function create(string $pathToFile, string $extension, array $params = []): FileReaderInterface
    {
        switch (strtolower($extension)) {
            case self::CSV:
                return new CsvReader($pathToFile, $params);
            default:
                throw new UnsupportedFileException("Файл с расширением '{$extension}' не поддерживается!");
        }
    }
}
