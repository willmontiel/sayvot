<?php

use Phalcon\Mvc\Model\Validator\Uniqueness;

class Subject extends BaseModel {
    public $idSubject;
    public $status;
    public $createdon;
    public $updatedon;
    public $name;
    public $description;
    
    public function initialize() {
        $this->hasMany("idSubject", "Subtopic", "idSubject");
    }
    
    public function validation() {
        $this->validate(new Uniqueness(array(
            'field' => 'name',
            "message" => "Ya existe un tema con el nombre ingresado"
        )));
        
        return $this->validationHasFailed() != true;
    }
}

