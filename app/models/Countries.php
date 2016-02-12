<?php

class Countries extends BaseModel {
    public $idcountry;
    public $currency_id;
    public $createdon;
    public $updatedon;
    public $codtel;
    public $name;
    public $status;
    
    public function initialize() {
        $this->belongsTo("currency_id", "Currency", "idcurrency");
    }
}
    