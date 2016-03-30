<?php

class BaseModel extends \Phalcon\Mvc\Model {
    public function initialize() {
        $this->useDynamicUpdate(true);
    }

    public function beforeCreate() {
        $this->createdon = time();
        $this->updatedon = time();
        $this->firstTime = 1;
    }

    public function beforeUpdate() {
        $this->updatedon = time();
    }
}
