<?php

/**
 * @author Rib
 */
class ErrorsCollector implements IErrorsCollector
{
    /**
     * @var string[] массив накопившихся ошибок
     */
    private static $errorsWarehouse=array();


    public function addError($errorDesc)
    {
        array_push(self::$errorsWarehouse,$errorDesc);
    }

    public function printErrors()
    {
        foreach (self::$errorsWarehouse as $errorDesc) {
            echo $errorDesc."\n";
        }
    }
}