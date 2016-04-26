<?php

use Phalcon\Mvc\Model\Validator\Email;

class Paymentdata extends BaseModel {

  public $idPaymentdata;
  public $idAccount;
  public $createdon;
  public $updatedon;
  public $status;
  public $fiscalNumber;
  public $name;
  public $email;

  public function initialize() {
    $this->belongsTo("idAccount", "Account", "idAccount");
  }

  public function validation() {
    $this->validate(new \Sayvot\Validators\SpaceValidator(array(
        'field' => 'name',
        "message" => "Debes enviar un nombre, al cual se deberá facturar"
    )));

    $this->validate(new Email(array(
        "field" => 'email',
        "message" => "Debes enviar una dirección de correo eléctronica válida"
    )));

    $this->validate(new \Sayvot\Validators\SpaceValidator(array(
        "field" => 'fiscalNumber',
        "message" => "Debes enviar un Número Fiscal/NIT/Número de identificacion válido"
    )));
    
    return $this->validationHasFailed() != true;
  }

}
