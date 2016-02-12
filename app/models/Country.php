<?php

class Country extends BaseModel {
    public $idCountry;
    public $idCurrency;
    public $createdon;
    public $updatedon;
    public $codtel;
    public $name;
    public $status;
    
    public function initialize() {
        $this->belongsTo("idCurrency", "Currency", "idCurrency");
    }
}
    