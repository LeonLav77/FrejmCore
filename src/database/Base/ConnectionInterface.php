<?php

namespace Leonlav77\Frejmcore\database\Base;

interface ConnectionInterface {
    public function connect();
    public function query($query);
}