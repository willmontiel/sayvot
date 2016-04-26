<?php

class User extends BaseModel {
    public $idUser;
    public $idAccount;
    public $agree;
    public $updatedon;
    public $createdon;
    public $status;
    public $name;
    public $lastname;
    public $phone;
    public $address;
    public $twitter;
    public $facebook;
    public $institute;
    
    public function initialize() {
        $this->hasOne("idUser", "Credential", "idUser");
        $this->belongsTo("idAccount", "Account", "idAccount");
    }
    
    public function validation() {
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            'field' => 'name',
            "message" => "Debes enviar tu nombre completo"
        )));
        
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            'field' => 'lastname',
            "message" => "Debes enviar tus apellidos"
        )));
        
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            "field"   => 'phone',
            "message" => "Debes un número de telefono o celular"
        )));
        
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            "field"  => 'address',
            "message" => "Debes enviar una dirección válida"
        )));
        
        return $this->validationHasFailed() != true;
    }
}
