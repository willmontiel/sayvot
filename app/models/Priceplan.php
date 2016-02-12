<?php

use Phalcon\Mvc\Model\Validator\Numericality;

class Priceplan extends BaseModel {
    public $idPriceplan;
    public $idCurrency;
    public $price;
    public $status;
    public $createdon;
    public $updatedon;
    
    public function initialize() {
        $this->belongsTo("idCurrency", "Currency", "idCurrency");
    }
    
    public function validation() {
        $this->validate(new Sayvot\Validators\SpaceValidator(array(
            'field' => 'price',
            "message" => "Debes enviar un valor, para el precio"
        )));

        $this->validate(new Numericality(array(
            "field"  => 'price',
            "message" => "Debes enviar un valor válido númerico, para el precio"
        )));
        
        return $this->validationHasFailed() != true;
    }
}

