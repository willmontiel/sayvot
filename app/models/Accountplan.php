<?php

use \Sayvot\Validators\SpaceValidator,
    Phalcon\Mvc\Model\Validator\Numericality,
    Phalcon\Mvc\Model\Validator\Uniqueness;

class Accountplan extends BaseModel {
    public $idAccountplan;
    public $idCountry;
    public $advertising;
    public $surveyQuantity;
    public $questionQuantity;
    public $userQuantity;
    public $sitesQuantity;
    public $createdon;
    public $updatedon;
    public $sendSMS;
    public $sendSMSAuto;
    public $quickView;
    public $exportContact;
    public $price;
    public $status;
    public $name;
    
    public function initialize() {
        $this->belongsTo("idCountry", "Country", "idCountry");
        $this->hasMany("idAccountplan", "Account", "idAccountplan");
    }
    
    public function validation() {
        $this->validate(new Numericality(array(
            "field"   => 'surveyQuantity',
            "message" => "Debes enviar una cantidad válida(númerica) de encuestas disponibles para este plan"
        )));
        
        $this->validate(new Numericality(array(
            "field"   => 'questionQuantity',
            "message" => "Debes enviar la cantidad válida(númerica) de preguntas disponibles para cada encuesta de este plan"
        )));
        
        $this->validate(new Numericality(array(
            "field"   => 'userQuantity',
            "message" => "Debes enviar la cantidad válida (númerica) de usuarios disponibles que pueden administrar la cuenta"
        )));
        
        $this->validate(new Numericality(array(
            "field"   => 'sitesQuantity',
            "message" => "Debes enviar la cantidad válida (númerica) de sitios disponibles que serán evualadas al momento de enviar el SMS automático"
        )));
        
        $this->validate(new Numericality(array(
            'field' => 'price',
            "message" => "Debes enviar un precio para este plan (Depende del tipo de moneda seleccionada)"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'name',
            "message" => "Debes enviar un nombre para identificar el plan"
        )));
        
        $this->validate(new Uniqueness(array(
            'field' => 'name',
            "message" => "Ya existe un plan de pago con el nombre ingresado"
        )));
        
        return $this->validationHasFailed() != true;
    }
}

