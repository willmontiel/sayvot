<?php

class Country extends BaseModel {
    public $idCountry;
    public $idCurrency;
    public $createdon;
    public $updatedon;
    public $phoneCode;
    public $name;
    public $status;
    
    public function initialize() {
        $this->belongsTo("idCurrency", "Currency", "idCurrency");
        $this->hasMany("idCountry", "Accountplan", "idCountry");
        $this->hasMany("idCountry", "State", "idCountry");
        $this->hasMany("idCountry", "Account", "idCountry");
    }
}
    