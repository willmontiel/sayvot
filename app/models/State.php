<?php

class State extends BaseModel {
    public $idState;
    public $idCurrency;
    public $createdon;
    public $updatedon;
    public $codtel;
    public $name;
    public $status;
    
    public function initialize() {
        $this->belongsTo("idCurrency", "Currency", "idCurrency");
        $this->hasMany("idState", "City", "idState");
    }
}