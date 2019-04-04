<?php

namespace App\Lib\FileReader\Readers;

use App\Lib\FileReader\Exceptions\FileNotFoundException;
use App\Lib\FileReader\Exceptions\FileNotReadableException;
use App\Lib\FileReader\Interfaces\FileReaderInterface;

abstract class FileReader implements FileReaderInterface
{
    /**
     * Абсолютный путь к файлу из которого происходит чтение записей.
     *
     * @var string
     */
    protected $pathToFile;

    /**
     * Ссылка на открытый для чтения файл.
     *
     * @var resource
     */
    protected $fileResource;

    /**
     * Указатель на запись для чтения.
     *
     * @see getNextEntry
     * @see hasNextEntry
     *
     * @var int
     */
    protected $entryPointer = 1;

    /**
     * Количество записей в файле.
     *
     * @var int
     */
    protected $countEntries = 0;

    /**
     * Содержит названия полей записей которые содержаться в файле.
     *
     * @var array
     */
    protected $entryFields = [];

    /**
     * Дополнительные параметры которые необходимы для процесса чтения записей из файла.
     *
     * @var array
     */
    protected $params = [];

    /**
     * @param string $pathToFile Абсолютный путь к файлу
     * @param array $params
     *
     * @throws FileNotFoundException
     * @throws FileNotReadableException
     */
    public function __construct(string $pathToFile, array $params)
    {
        $this->pathToFile = $pathToFile;
        $this->setParams($params);

        if (!file_exists($this->pathToFile)) {
            throw new FileNotFoundException("Файл '{$this->pathToFile}' не существует!");
        }

        if (!is_readable($this->pathToFile)) {
            throw new FileNotReadableException("Файл '{$this->pathToFile}' не доступен для чтения!");
        }

        $this->openFile();
        $this->setNumberEntries();
        $this->setEntryFields();
    }

    protected function setParams(array $params)
    {
        $this->params = array_merge($this->params, $params);
    }

    /**
     * Подсчитывает количество записей в файле и записывает полученное количество в свойство @see $countEntries.
     *
     * @return void
     */
    abstract protected function setNumberEntries();

    /**
     * Устанавливает значение переменной @see $entryFields
     *
     * @return void
     */
    abstract protected function setEntryFields();

    /**
     * Возвращает количество записей в файле.
     *
     * @return int
     */
    public function getNumberEntries(): int
    {
        return $this->countEntries;
    }

    /**
     * Открывает файл для чтения из него записей, ссылку на ресурс необходимо записать в свойство @see $fileResource.
     *
     * @throws FileNotReadableException
     *
     * @return void
     */
    abstract protected function openFile();

    /**
     * Закрытие открытого для чтения файла.
     *
     * @return void
     */
    abstract protected function closeFile();

    public function __destruct()
    {
        $this->closeFile();
    }

    public function getFilePath()
    {
        return $this->pathToFile;
    }
}
