<?php

use Phalcon\Mvc\Model\Validator\Uniqueness,
    Phalcon\Mvc\Model\Validator\Email;

class Credential extends BaseModel {
    public $idCredential;
    public $idUser;
    public $updatedon;
    public $createdon;
    public $firstTime;
    public $username;
    public $password;
    
    public function initialize() {
        $this->belongsTo("idUser", "User", "idUser");
    }
    
    public function validation() {
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            "field" => "password",
            "message" => "No ha ingresado una contraseña, (minimo 8 caracteres)"
        )));

        $this->validate(new StringLength(array(
            "field" => "password",
            "min" => 6,
            "message" => "La contraseña es muy corta, debe estar entre 8 y 40 caracteres"
        )));

        $this->validate(new Email(array(
            "field"   => 'email',
            "message" => "Debes enviar una dirección de correo eléctronico válida"
        )));

        $this->validate(new Uniqueness(array(
            'field' => 'email',
            "message" => "Ya existe un perfil con la dirección de correo eléctronico ingresada"
        )));

        return $this->validationHasFailed() != true;
    }
}