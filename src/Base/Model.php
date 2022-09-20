<?php

namespace Leonlav77\Frejmcore\Base;


use Leonlav77\Frejmcore\Traits\HasEloquent;
use Leonlav77\Frejmcore\database\Base\ConnectionInterface;

abstract class Model extends HasEloquent {

    public $table;
    public static $conn;

    public function __construct($class) {
       $className = get_class($class);
       $this->table = strtolower(substr($className, strrpos($className, '\\') + 1)) . 's';
    }
    public static function setConnection(ConnectionInterface $conn) {
        self::$conn = $conn;
    }
    public function setAttribute($name, $value) {
        $this->$name = $value;
    }
}