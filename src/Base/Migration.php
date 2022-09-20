<?php

namespace Leonlav77\Frejmcore\Base;

abstract class Migration {
    public function __invoke() {
        $this->up();
    }
    public function up(){}
    public function down(){}
}