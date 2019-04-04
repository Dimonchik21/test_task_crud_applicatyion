<?php


namespace App\Lib\Db;


use App\Lib\FileReader\Readers\FileReader;

class CSV
{
    private $tableName;

    private $reader;

    public function __construct(FileReader $reader)
    {
        $this->reader = $reader;
        $this->tableName = basename($reader->getFilePath());
    }

    public function save($data)
    {
        $this->reader->saveArrayToCsv($data);
    }

    public function getCSVArray()
    {
        $data = [];

        while ($result = $this->reader->getNextEntry()) {
            $data[] = $result;
        }

        return $data;
    }
}