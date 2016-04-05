<?php

use Phalcon\Mvc\Model\Validator\Email,
    Phalcon\Mvc\Model\Validator\Uniqueness;

class Account extends BaseModel {
    public $idAccount;
    public $idAccountplan;
    public $idAccounttype;
    public $idCountry;
    public $createdon;
    public $updatedon;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $nit;
    public $city;
    public $status;
    
    public function initialize() {
        $this->belongsTo("idCountry", "Country", "idCountry");
        $this->belongsTo("idAccountplan", "Accountplan", "idAccountplan");
        $this->belongsTo("idAccounttype", "Accounttype", "idAccounttype");
        $this->hasMany("idAccount", "User", "idAccount");
    }
    
    public function validation() {
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            'field' => 'name',
            "message" => "Debes enviar un nombre, para identificar la cuenta"
        )));

        $this->validate(new Uniqueness(array(
            'field' => 'name',
            "message" => "Ya existe una cuenta con el nombre ingresado"
        )));
        
        $this->validate(new Email(array(
            "field"   => 'email',
            "message" => "Debes enviar una dirección de correo eléctronica válida"
        )));
        
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            "field"   => 'phone',
            "message" => "Debes un número de telefono o celular"
        )));
        
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            "field"  => 'address',
            "message" => "Debes enviar una dirección válida"
        )));
        
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            "field"  => 'city',
            "message" => "Debes enviar una ciudad válida"
        )));
        
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            'field' => 'idAccountplan',
            "message" => "Debes seleccionar un plan de pago"
        )));
        
        return $this->validationHasFailed() != true;
    }
}

