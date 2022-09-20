<?php

namespace Base;

class Response {
    
        public $data;
    
        public function __construct($data){
            $this->data = $data;
        }
    
}