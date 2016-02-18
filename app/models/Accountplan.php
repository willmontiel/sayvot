<?php

use Phalcon\Mvc\Model\Validator\Email,
    \Sayvot\Validators\SpaceValidator,
    Phalcon\Mvc\Model\Validator\Numericality;

class Accountplan extends BaseModel {
    public $idAccountplan;
    public $idCurrency;
    public $idAutomatedsmsplan;
    public $idAdvertising;
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
        $this->belongsTo("idCurrency", "Currency", "idCurrency");
    }
    
    public function validation() {
        $this->validate(new SpaceValidator(array(
            'field' => 'surveyQuantity',
            "message" => "Debes enviar la cantidad de encuestas disponibles para este plan"
        )));

        $this->validate(new Numericality(array(
            "field"   => 'surveyQuantity',
            "message" => "Debes enviar una cantidad válida(númerica) de encuestas disponibles para este plan"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'questionQuantity',
            "message" => "Debes enviar la cantidad de preguntas disponibles para cada encuesta de este plan"
        )));

        $this->validate(new Numericality(array(
            "field"   => 'questionQuantity',
            "message" => "Debes enviar la cantidad válida(númerica) de preguntas disponibles para cada encuesta de este plan"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'userQuantity',
            "message" => "Debes enviar la cantidad de usuarios disponibles que pueden administrar la cuenta"
        )));

        $this->validate(new Numericality(array(
            "field"   => 'userQuantity',
            "message" => "Debes enviar la cantidad válida(númerica) de usuarios disponibles que pueden administrar la cuenta"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'sitesQuantity',
            "message" => "Debes enviar la cantidad de sedes disponibles que serán evualadas al momento de enviar el SMS automático"
        )));

        $this->validate(new Numericality(array(
            "field"   => 'sitesQuantity',
            "message" => "Debes enviar la cantidad válida(númerica) de sedes disponibles que serán evualadas al momento de enviar el SMS automático"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'sendSMS',
            "message" => "Debes configurar si este plan permite el envío de SMS"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'sendSMSAuto',
            "message" => "Debes configurar si este plan permite el envío de SMS automáticos(Depende también de la cantidad de sitios configurada)"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'quickView',
            "message" => "Debes configurar si este plan permite la vista rápida"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'exportContact',
            "message" => "Debes configurar si este plan permite la exportación de contactos"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'price',
            "message" => "Debes enviar un precio para este plan(Depende del tipo de moneda seleccionada)"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'name',
            "message" => "Debes enviar un nombre para identificar el plan"
        )));
        
        return $this->validationHasFailed() != true;
    }
}

