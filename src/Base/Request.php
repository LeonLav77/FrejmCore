<?php

namespace Leonlav77\Frejmcore\Base;

class Request {

    public $uri;
    public $fullUri;
    public $method;
    public $params;
    public $server;

    public function __construct(){
        $this->fullUri = $_SERVER['REQUEST_URI'];
        if($this->fullUri[strlen($this->fullUri) - 1] == '/'){
            $this->fullUri = substr($this->fullUri, 0, -1);
        }
        if($this->fullUri){
            $this->uri = '/'.explode('/', $this->fullUri)[1];
        }else{
            $this->uri = '/';
        }
        
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = $_REQUEST;
        $this->server = $_SERVER;

    }
}