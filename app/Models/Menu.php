<?php

namespace App\Models;

use App\Core\Model;

class Menu extends Model
{
    /**
     * @return mixed
     * @throws \App\Lib\FileReader\Exceptions\FileNotFoundException
     * @throws \App\Lib\FileReader\Exceptions\FileNotReadableException
     * @throws \App\Lib\FileReader\Exceptions\UnsupportedFileException
     */
    public function getMenu()
    {
        $result = $this->rowTables('menu');

        return $result->getCSVArray();
    }

    /**
     * @param array $data
     * @return mixed
     * @throws \App\Lib\FileReader\Exceptions\FileNotFoundException
     * @throws \App\Lib\FileReader\Exceptions\FileNotReadableException
     * @throws \App\Lib\FileReader\Exceptions\UnsupportedFileException
     */
    public function save(array $data)
    {
        $menuXmlFile = $this->rowTables('menu');

        return $menuXmlFile->save($data);
    }
}