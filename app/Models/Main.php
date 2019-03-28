<?php

namespace App\Models;

use App\Core\Model;

class Main extends Model
{
    public function getMenu()
    {
        $result = $this->db->row('menu');

        return $result;
    }
}