<?php

namespace App\Core;

use App\Lib\Db;
use App\Lib\File;

abstract class Model
{
    public $db;

    public function __construct()
    {
        $this->db = new File();
    }
}