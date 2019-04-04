<?php

namespace App\Lib\FileReader\Readers;

use \App\Lib\FileReader\Exceptions\FileNotReadableException;

class CsvReader extends FileReader
{
    protected $params = [
        'length' => 0,
        'delimiter' => ';',
        'enclosure' => '"',
        'escape' => '\\',
    ];

    public function hasNextEntry(): bool
    {
        return $this->countEntries != 0
            && $this->entryPointer <= $this->countEntries;
    }

    public function getNextEntry(): array
    {
        if (!$this->hasNextEntry()) {
            return [];
        }

        $entry = [];
        $rawEntry = $this->getCsvRow();

        foreach ($this->entryFields as $key => $name) {
            $entry[$name] = $rawEntry[$key];
        }

        $this->entryPointer++;

        return $entry;
    }

    public function resetPointer()
    {
        $this->entryPointer = 1;
        rewind($this->fileResource);
    }

    protected function openFile()
    {
        if (!$resource = fopen($this->pathToFile, 'r+')) {
            throw new FileNotReadableException(
                "Не удалось прочитать файл '{$this->pathToFile}'."
            );
        }

        $this->fileResource = $resource;
    }

    protected function setNumberEntries()
    {
        $countEntries = 0;

        while ($this->getCsvRow()) {
            $countEntries++;
        }

        rewind($this->fileResource);

        $this->countEntries = $countEntries - 1; // в первой строке файла содержатся заголовки
    }

    protected function setEntryFields()
    {
        $this->entryFields = $this->getCsvRow();
    }

    protected function getCsvRow()
    {
        return fgetcsv(
            $this->fileResource,
            $this->params['length'],
            $this->params['delimiter'],
            $this->params['enclosure'],
            $this->params['escape']
        );
    }

    protected function closeFile()
    {
        if ($this->fileResource) {
            fclose($this->fileResource);
            $this->fileResource = null;
        }
    }

    public function saveArrayToCsv(array $data)
    {
        $dataToSave = [];

        foreach ($data as $name => $value) {
            if (empty($dataToSave)) {
                $dataToSave[] = array_keys($value);
                continue;
            }

            $dataToSave[] = array_values($value);
        }

        try {
            $this->openFile();

            foreach ($dataToSave as $item) {
                fputcsv($this->fileResource, $item);
            }

            $this->closeFile();
        } catch (\Exception $exception) {
            return false;
        }

        return true;
    }
}
