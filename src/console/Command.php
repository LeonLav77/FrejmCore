<?php

namespace Leonlav77\Frejmcore\console;

use Leonlav77\Frejmcore\console\MakeFile;

class Command {
    public $command;
    public $args = [];
    public $makeable_classes = [
        'controller',
        'model',
        'migration',
        'middleware',
    ];
    public function __construct($input) {
        $input = array_slice($input, 1, 2);
        if (count($input) == 0) {
            $this->command = 'help';
            return;
        }
        $this->command = $input[0];
        $input = array_slice($input, 1, 2);
        if (count($input) > 0) {
            foreach ($input as $arg) {
                $this->args[] = $arg;
            }
        }
    }

    public function run(){
        $command = $this->parseCommand($this->command);
        $commandName  = $command['name'];
        $commandArg = $command['arg'];
        try {
            $this->$commandName($commandArg);
        } catch (\Throwable $th) {
            echo "Command {} does not exist.\n";
        }
    }

    public function parseCommand($command){  
        $command = explode(':', $command);
        if(count($command) == 1){
            $commandName = $command[0];
            $commandArg = null;
        }else {
            $commandName = $command[0];
            $commandArg = $command[1];
        }
        return [
            'name' => $commandName,
            'arg' => $commandArg
        ];
    }

    public function help($arg = null){
        echo "Available commands:\n
        - make:controller [name] - create new controller\n
        - make:model [name] - create new model\n
        - make:migration [name] - create new migration\n
        - make:middleware [name] - create new middleware\n
        - migrate - run all migrations\n
        - help - show this message\n
        - serve - start the server\n";
    }

    public function migrate($arg = null){
        $migrations = scandir(baseDir() . "\database\migrations");
        $migrations = array_filter($migrations, function($migration){
            return $migration != "." && $migration != "..";
        });
        $migrations = array_map(function($migration){
            return "database\\migrations\\" . str_replace(".php", "", $migration);
        }, $migrations);

        try {
            foreach($migrations as $migration){
                require_once baseDir() . str_replace("\\", "\\", $migration) . ".php";
                $migration = new $migration;
                // $migration->up();
            }
        } catch (\Throwable $th) {
            echo "Error: " . $th->getMessage() . ". \n";
        }
        echo "Migrated";
    }
    public function make($arg = null){
        if($arg == null || !in_array($arg, $this->makeable_classes) || !isset($this->args[0])){	
            echo "This is make command. It will make new file. Don't forget the name of the file\n";
            echo "Available args: controller, model, migration, middleware\n";
            return;
        }
        MakeFile::$arg($this->args[0]);
    }

    public function serve($arg = null){
        echo "Server started at http://localhost:8000\n";
        exec("php -S localhost:8000 -t public");
    }
}