<?php

namespace App\Lib\Db\Type;

class CSV
{
    private $csv;

    private $separator = ';';

    public function __construct($param)
    {
        if (!is_array($param)) {
            $this->readFromFile($param);
        } else {
            $this->csv = $param;
        }

        return $this;
    }

    public function readFromFile($fileName)
    {
        if (file_exists($fileName)) {
            $file = fopen($fileName, 'r');
            $columnName = explode($this->separator, fgets($file));

            while (!feof($file)) {
                $str = fgets($file);

                if (trim($str) != '') {
                    $data[] = explode($this->separator, $str);
                }
            }

            fclose($file);

            foreach ($data as $line) {
                $row = [];

                foreach ($columnName as $col_num => $colName) {
                    $row[trim($colName)] = trim($line[$col_num]);
                }

                $this->csv[] = $row;
            }
        } else {
            trigger_error('CSV: "' . $fileName . '" does not exist.', E_USER_ERROR);
            die();
        }
    }

    public function saveToFile($fileName, $deleteEmptyColumns, $overwrite)
    {
        if ($overwrite || !file_exists($fileName)) {
            $file = fopen($fileName, 'w');
            $line = '';

            foreach ($this->getColumnNames() as $columnName) {
                if (!($columnName == '' && $this->emptyColumn($this->getValuesByColumnName($columnName))) || !$deleteEmptyColumns) {
                    $line = $line . trim($columnName) . $this->separator;
                }
            }

            fputs($file, substr($line, 0, -1) . "\n");

            for ($i = 0; $i < $this->getRowCount(); $i++) {
                $line = '';

                foreach ($this->csv as $colName => $colValues) {
                    if (!($colName == '' && $this->emptyColumn($colValues)) || !$deleteEmptyColumns) {
                        $line = $line . trim($colValues[$i]) . $this->separator;
                    }
                }

                fputs($file, substr($line, 0, -1) . "\n");
            }

            fclose($file);

            return true;
        }

        return false;
    }

    public function getCSVArray()
    {
        return $this->csv;
    }

    public function setCSVArray($array)
    {
        $this->csv = $array;
    }

    public function setSeparator($separator)
    {
        $this->separator = $separator;
    }

    public function getColumnNames()
    {
        foreach ($this->csv as $name => $value) {
            $result[] = $name;
        }

        return $result;
    }

    public function getValuesByColumnName($columnName)
    {
        if ($this->columnExists($columnName)) {
            return $this->csv[$columnName];
        } else {
            trigger_error('CSV: Header "' . $columnName . '" does not exist.');
        }
    }

    public function columnExists($columnName)
    {
        return in_array($columnName, $this->getColumnNames());
    }

    public function getColCount()
    {
        return count($this->csv);
    }

    public function getRowCount()
    {
        $columnNames = $this->getColumnNames();

        return count($this->csv[$columnNames[0]]);
    }

    public function emptyColumn($array)
    {
        $empty = true;
        foreach ($array as $value) {
            if (trim($value) != '') {
                $empty = false;
                break;
            }
        }
        return $empty;
    }

    public function getRows()
    {
        for ($i = 0; $i < $this->getRowCount(); $i++) {
            foreach ($this->csv as $value) {
                $rows[$i][] = $value[$i];
            }
        }
        return $rows;
    }
}
