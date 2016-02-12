<?php

use Phalcon\Mvc\Model\Validator\PresenceOf,
    Phalcon\Mvc\Model\Validator\Email;

class Accounts extends BaseModel {
    public $idaccount;
    public $countries_id;
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
        $this->belongsTo("countries_id", "Countries", "idcountry");
    }
    
    public function validation() {
        $this->validate(new PresenceOf( array(
            "field"  => 'name',
            "message" => "Debes enviar un nombre, para identificar la cuenta"
        )));
        
        $this->validate(new SpaceValidator(array(
            'field' => 'name',
            "message" => "Debes enviar un nombre, para identificar la cuenta"
        )));

        $this->validate(new Email(array(
            "field"   => 'email',
            "message" => "Debes enviar una dirección de correo eléctronica válida"
        )));
        
        $this->validate( new PresenceOf(array(
            "field"   => 'phone',
            "message" => "Debes un número de telefono o celular"
        )));
        
        $this->validate(new SpaceValidator(array(
            "field"   => 'phone',
            "message" => "Debes un número de telefono o celular"
        )));
        
        $this->validate(new PresenceOf(array(
            "field"   => 'status',
            "message" => "Debes configurar un estado para la cuenta (Activa o Inactiva)"
        )));
        
        $this->validate(new SpaceValidator(array(
            "field"   => 'status',
            "message" => "Debes configurar un estado para la cuenta (Activa o Inactiva)"
        )));
        
        $this->validate(new PresenceOf(array(
            "field"  => 'address',
            "message" => "Debes enviar una dirección válida"
        )));
        
        $this->validate(new SpaceValidator(array(
            "field"  => 'address',
            "message" => "Debes enviar una dirección válida"
        )));
        
        $this->validate(new PresenceOf(array(
            "field"  => 'city',
            "message" => "Debes enviar una ciudad válida"
        )));
        
        $this->validate(new SpaceValidator(array(
            "field"  => 'city',
            "message" => "Debes enviar una ciudad válida"
        )));
        
        return $this->validationHasFailed() != true;
    }
}

