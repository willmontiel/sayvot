<?php

use Phalcon\Mvc\Model\Validator\PresenceOf;

class Currency extends BaseModel {
    public $idcurrency;
    public $name;
    public $code;
    public $status;
    public $simbol;
    
    public function validation() {
        $this->validate(
            new PresenceOf(
                array(
                    "field"  => "name",
                    "message" => "Debes enviar un nombre, para el tipo de moneda"
                )
            )
        );

        $this->validate(
            new PresenceOf(
                array(
                    "field"   => "code",
                    "message" => "Debes enviar un código, para el tipo de moneda"
                )
            )
        );
        
        $this->validate(
            new PresenceOf(
                array(
                    "field"   => "simbol",
                    "message" => "Debes enviar un símbolo, para el tipo de moneda"
                )
            )
        );
        
        $this->validate(
            new PresenceOf(
                array(
                    "field"   => "status",
                    "message" => "Debes enviar un estado, para el tipo de moneda"
                )
            )
        );

        return $this->validationHasFailed() != true;
    }
}

