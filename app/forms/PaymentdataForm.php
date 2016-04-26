<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Email;

class PaymentdataForm extends Form {
    public function initialize(Account $account) {
        $this->add(new Text('name', array(
            'maxlength' => 45,
            'type' => 'text',
            'placeholder' => 'Nombre a quien facturar',
            'required' => 'required',
            'autofocus' => 'autofocus',
            'class' => 'form-control',
            'id' => 'name',
            'value' => $account->name
        )));
        
        $this->add(new Text('fiscalNumber', array(
            'maxlength' => 45,
            'type' => 'text',
            'placeholder' => 'Número Fiscal/NIT/Número de identificacion',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'fiscalNumber',
            'value' => $account->nit
        )));
        
        $this->add(new Email('email', array(
            'maxlength' => 45,
            'type' => 'text',
            'placeholder' => 'Correo de facturación',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'email',
            'value' => $account->email
        )));
    }
}