<?php

class State extends BaseModel {
    public $idState;
    public $idCountry;
    public $createdon;
    public $updatedon;
    public $codtel;
    public $name;
    public $status;
    
    public function initialize() {
        $this->belongsTo("idCountry", "Country", "idCountry");
        $this->hasMany("idState", "City", "idState");
    }
}