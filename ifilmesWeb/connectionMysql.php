<?php

/**
 * Created by PhpStorm.
 * User: kassiano
 * Date: 26/06/2016
 * Time: 15:59
 */
class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO('mysql:host=localhost;dbname=iFilmes', 'root', 'bcd127', $pdo_options);
        }
        return self::$instance;
    }
}
