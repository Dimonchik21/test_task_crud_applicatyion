<?php

namespace App\Lib;

class File
{
    protected $filePath;

    public function __construct()
    {
        $config = require  'app/Config/db.php';

        foreach ($config as $name => $path) {
            $this->filePath[$name] = simplexml_load_file($path);
        }
    }
    public function row($fileName)
    {
        $results = [];

        /** @var \SimpleXMLElement $xml */
        $xml = $this->filePath[$fileName];


        foreach ($xml->paragraph as $name => $paragraph) {
            $i = 0;
            $attributes = [];

            foreach ($paragraph->attributes() as $name => $attribute) {
                $attributes[$name] = (string)$attribute;
            }

            $results[] = $attributes;

            $i++;
        }

        return $results;
    }
}