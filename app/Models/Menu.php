<?php

namespace App\Models;

use App\Core\Model;

class Menu extends Model
{
    public function getMenu()
    {
        $result = $this->rowTables('menu');

        return $result->getCSVArray();
    }
}