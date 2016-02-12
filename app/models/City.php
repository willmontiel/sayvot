<?php

class City extends BaseModel {
    public $idCity;
    public $idState;
    public $createdon;
    public $updatedon;
    public $name;
    public $status;
    
    public function initialize() {
        $this->belongsTo("idState", "State", "idState");
    }
}