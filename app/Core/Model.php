<?php

namespace App\Core;

use App\Lib\Db;
use App\Lib\Db\Type\CSV;
use App\Lib\Db\FileReader;

abstract class Model
{
    public $db;

    public $fileReader;

    public function __construct()
    {
        $this->fileReader = new FileReader();
    }

    public function rowTables($tableName)
    {
        if (empty($tableName)) {
            return null;
        }

        $config = include(ROOT . '/app/Config/db.php');

        $this->db = $this->fileReader->read($config[$tableName]);

        return $this->db;
    }
}