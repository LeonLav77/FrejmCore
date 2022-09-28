<?php
namespace Leonlav77\Frejmcore\database\Base;

use stdClass;
use Leonlav77\Frejmcore\Base\Model;
use Leonlav77\Frejmcore\helpers\MySqli;
namespace Leonlav77\Frejmcore\database\Base;

class QueryExcecutor{
    public static $conn;
    public static function execute($query, $model = 'stdClass'){
        try {
            $output = self::$conn->query($query);
          } catch ( \Exception $e ) {
            echo $e->getMessage();
            die();
          }
        if(gettype($output) == 'boolean'){
            return $output;
        }
        $result = MySqli::standardizeOutput($output);
        $result = self::convertToModel($result, $model);
        return $result;
    }
    private static function convertToModel($input, $model = 'stdClass'){
        $output = [];
        foreach($input as $key => $value){
            $newModel = new $model();
            foreach($value as $attributeName => $attributeValue){
                if($newModel instanceof Model){
                    $newModel->setAttribute($attributeName, $attributeValue);
                    continue;
                }
                $newModel->$attributeName = $attributeValue;
            }
            $output[$key] = $newModel;
        }
        return $output;
    }
    
    public static function setConnection(ConnectionInterface $conn) {
        self::$conn = $conn;
    }
}