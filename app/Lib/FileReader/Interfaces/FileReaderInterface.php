<?php

namespace App\Lib\FileReader\Interfaces;

interface FileReaderInterface
{
    /**
     * Возвращает количество записей в файле.
     *
     * @return int
     */
    public function getNumberEntries(): int;

    /**
     * Метод возвращающий по порядку одну за другой записи из файла.
     *
     * @return array Массив содержащий данные записи
     */
    public function getNextEntry(): array;

    /**
     * Проверяет наличие следующей записи в файле.
     *
     * @return bool
     */
    public function hasNextEntry(): bool;

    /**
     * Переводит указатель на первую запись в файле.
     *
     * @return void
     */
    public function resetPointer();
}
