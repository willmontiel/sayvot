<?php

class Accounttype extends BaseModel {
    public $idAccounttype;
    public $name;
    public $createdon;
    public $updatedon;
    
    public function initialize() {
        $this->hasMany("idAccounttype", "Account", "idAccounttype");
    }
}