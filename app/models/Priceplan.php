<?php

use Phalcon\Mvc\Model\Validator\PresenceOf,
    Phalcon\Mvc\Model\Validator\Numericality;

class Priceplan extends BaseModel {
    public $idpriceplan;
    public $currency_id;
    public $price;
    public $status;
    public $createdon;
    public $updatedon;
    
    public function initialize() {
        $this->belongsTo("currency_id", "Currency", "idcurrency");
    }
    
    public function validation() {
        $this->validate(new PresenceOf( array(
            "field"  => 'price',
            "message" => "Debes enviar un valor, para el precio"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'price',
            "message" => "Debes enviar un valor, para el precio"
        )));

        $this->validate(new Numericality(array(
            "field"  => 'price',
            "message" => "Debes enviar un valor válido númerico, para el precio"
        )));
        
        $this->validate(new PresenceOf(array(
            "field"   => 'status',
            "message" => "Debes enviar un estado, para el tipo de moneda"
        )));
        
        $this->validate(new SpaceValidator(array(
            "field"   => 'status',
            "message" => "Debes enviar un estado, para el tipo de moneda"
        )));
        
        return $this->validationHasFailed() != true;
    }
}

