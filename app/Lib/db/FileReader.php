<?php

namespace App\Lib\Db;

use App\Lib\Db\Type\CSV;
use InvalidArgumentException;

class FileReader
{
    const CSV = 'csv';

    public static function read(string $pathToFile)
    {
        if (empty($pathToFile) || !file_exists($pathToFile) || !is_file($pathToFile)) {
            throw new InvalidArgumentException("Некорректный путь к файлу!");
        }

        $pathInfo = pathinfo($pathToFile);
        $type = $pathInfo['extension'];

        return self::create($pathToFile, $type);
    }

    /**
     *
     */
    private static function create(string $pathToFile, $type)
    {
        switch (strtolower($type)) {
            case self::CSV:
                return new CSV($pathToFile);
            default:
                throw new InvalidArgumentException("Файл с расширением '{$type}' не поддерживается!");
        }
    }
}
