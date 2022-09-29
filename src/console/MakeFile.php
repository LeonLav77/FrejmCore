<?php

namespace Leonlav77\Frejmcore\console;

class MakeFile {
    public static function controller($name){
        if (file_exists(baseDir() . 'App/Http/Controllers/' . $name .'.php')) {
            echo "Controller already exists.\n";
            return;
        }
        fopen(baseDir() . 'App/Http/Controllers/'. $name .'.php', 'w');
        $template = file_get_contents(__DIR__ . '/templates/controller_template.txt');
        $template = str_replace('{$name}', $name, $template);
        file_put_contents(baseDir() . 'App/Http/Controllers/' . $name .'.php', $template);
        echo "Controller created.\n";

    }
    public static function model($name){
        if (file_exists(baseDir() . 'App/Http/Models/'. $name .'.php')) {
            echo "Controller already exists.\n";
            return;
        }
        fopen(baseDir() . 'App/Models/'. $name .'.php', 'w');
        $template = file_get_contents(__DIR__ . '/templates/model_template.txt');
        $template = str_replace('{$name}', $name, $template);
        file_put_contents(baseDir() . 'App/Models/'. $name .'.php', $template);
        echo "Model created.\n";
    }
    public static function migration($name){
        if (file_exists(baseDir() . 'database/migrations/'. $name .'.php')) {
            echo "Migration already exists.\n";
            return;
        }
        $table = self::getTableName($name);
        fopen(baseDir() . 'database/migrations/'. $name .'.php', 'w');
        $template = file_get_contents(__DIR__ . '/templates/migration_template.txt');
        $template = str_replace('{$name}', $name, $template);
        $template = str_replace('{$table}', $table, $template);
        file_put_contents(baseDir() . 'database/migrations/'. $name .'.php', $template);
        echo "Migration created.\n";
    }
    public static function middleware($name){
        if (file_exists(baseDir() . 'App/Http/Middleware/'. $name .'.php')) {
            echo "Middleware already exists.\n";
            return;
        }
        fopen(baseDir() . 'App/Http/Middleware/'. $name .'.php', 'w');
        $template = file_get_contents(__DIR__ . '/templates/middleware_template.txt');
        $template = str_replace('{$name}', $name, $template);
        file_put_contents(baseDir() . 'App/Http/Middleware/'. $name .'.php', $template);
        echo "This is middleware command. It will create middleware file.\n";
    }
    public static function getTableName($name){
        $name = strtolower($name);
        $newName = explode('_', $name);
        if(count($newName) == 3){
            return $newName[1];
        }
        return $name;
    }
}