<?php

class Credential extends BaseModel {
    public $idCredential;
    public $updatedon;
    public $createdon;
    public $firstTime;
    public $username;
    public $password;
    
    public function initialize() {
        $this->hasOne("idCredential", "Credential", "idCredential");
    }
    
    public function validation() {
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            'field' => 'name',
            "message" => "Debes enviar tu nombre completo"
        )));
        
        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            "field" => "password",
            "message" => "No ha ingresado una contraseña, (minimo 8 caracteres)"
        )));

        $this->validate(new StringLength(array(
            "field" => "password",
            "min" => 8,
            "message" => "La contraseña es muy corta, debe estar entre 8 y 40 caracteres"
        )));

        $this->validate(new \Sayvot\Validators\SpaceValidator(array(
            "field" => "username",
            "message" => "Por favor ingrese el nombre de usuario, se necesitará para iniciar sesión"
        )));

        $this->validate(new StringLength(array(
                "field" => "username",
                "min" => 4,
                "message" => "El nombre de usuario es muy corto, debe tener al menos 4 caracteres"
        )));

        $this->validate(new Regex(array(
            'field' => 'username',
            'pattern' => '/^[a-z0-9\._-]{4,30}/',
            'message' => 'El nombre de usuario no debe tener espacios ni caracteres especiales, tampoco letras mayúsculas y debe tener mínimo 4 y máximo 30 caracteres'
        )));
        
        return $this->validationHasFailed() != true;
    }
}