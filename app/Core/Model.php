<?php

namespace App\Core;

use App\Lib\Db\CSV;
use App\Lib\FileReader\FileReaderFactory;

abstract class Model
{
    public $db;

    public $fileReader;

    /**
     * @param $tableName
     * @return null
     * @throws \App\Lib\FileReader\Exceptions\FileNotFoundException
     * @throws \App\Lib\FileReader\Exceptions\FileNotReadableException
     * @throws \App\Lib\FileReader\Exceptions\UnsupportedFileException
     */
    public function rowTables($tableName)
    {
        if (empty($tableName)) {
            return null;
        }

        $config = include(ROOT . '/app/Config/db.php');

        $this->fileReader = FileReaderFactory::create($config[$tableName], 'csv');
        $this->db = new CSV($this->fileReader);

        return $this->db;
    }

    /**
     * @param $tableName
     * @return mixed
     */
    protected function getFilePath($tableName)
    {
        $config = include(ROOT . '/app/Config/db.php');

        return $config[$tableName];
    }
}