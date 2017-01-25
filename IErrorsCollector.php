<?php
/**
 * Интерфейс для сборщика ошибок
 * @author Rib
 */
interface IErrorsCollector {
    /**
     * Добавить ошибку в сборщик ошибок
     * @param $errorDesc string Описание ошибки
     * @return void
     */
    public function addError($errorDesc);

    /**
     * Вывести ошибки
     * @return void
     */
    public function printErrors();
}