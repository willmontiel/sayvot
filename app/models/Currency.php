<?php

use Phalcon\Mvc\Model\Validator\PresenceOf,
    Phalcon\Mvc\Model\Validator\Numericality;

class Currency extends BaseModel {
    public $idCurrency;
    public $name;
    public $code;
    public $status;
    public $simbol;
    public $value;
    public $createdon;
    public $updatedon;
    
    public function initialize() {
        $this->hasMany("idCurrency", "Priceplan", "idCurrency");
        $this->hasMany("idCurrency", "Country", "idCurrency");
    }
    
    public function validation() {
        $this->validate(new PresenceOf( array(
            "field"  => 'name',
            "message" => "Debes enviar un nombre, para el tipo de moneda"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'name',
            "message" => "Debes enviar un nombre, para el tipo de moneda"
        )));

        $this->validate(new PresenceOf(array(
            "field"   => 'code',
            "message" => "Debes enviar un código, para el tipo de moneda"
        )));
        
        $this->validate(new SpaceValidator(array(
            "field"   => 'code',
            "message" => "Debes enviar un código, para el tipo de moneda"
        )));
        
        $this->validate( new PresenceOf(array(
            "field"   => 'simbol',
            "message" => "Debes enviar un símbolo, para el tipo de moneda"
        )));
        
        $this->validate(new SpaceValidator(array(
            "field"   => 'simbol',
            "message" => "Debes enviar un símbolo, para el tipo de moneda"
        )));
        
        $this->validate(new PresenceOf(array(
            "field"  => 'value',
            "message" => "Debes enviar un valor válido, para el TRM"
        )));
        
        $this->validate(new SpaceValidator(array(
            "field"  => 'value',
            "message" => "Debes enviar un valor válido, para el TRM"
        )));
        
        $this->validate(new Numericality(array(
            "field"  => 'value',
            "message" => "Debes enviar un valor válido, para el TRM"
        )));
        
        return $this->validationHasFailed() != true;
    }
}

