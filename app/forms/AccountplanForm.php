<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Numeric,
    Phalcon\Forms\Element\Check;

class AccountplanForm extends Form {
    public function initialize() {
        $this->add(new Text('name', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Nombre',
            'required' => 'required',
            'autofocus' => "autofocus",
            'class' => 'form-control',
            'id' => 'name'
        )));
        
        $this->add(new Select('idCurrency', Currency::find(), array(
            'using' => array('idCurrency', 'name'),
            'class' => 'form-control select2',
            'required' => 'required',
            'id' => 'idCurrency'
        )));
        
        $this->add(new Numeric('surveyQuantity', array(
            'maxlength' => 11,
            'min' => 0,
            'placeholder' => 'Cantidad de encuestas',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'surveyQuantity'
        )));
        
        $this->add(new Numeric('questionQuantity', array(
            'maxlength' => 11,
            'min' => 0,
            'placeholder' => 'Cantidad de preguntas por encuesta',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'questionQuantity'
        )));
        
        $this->add(new Numeric('userQuantity', array(
            'maxlength' => 11,
            'min' => 0,
            'placeholder' => 'Cantidad de usuarios permitidos en la cuenta',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'userQuantity'
        )));
        
        $this->add(new Numeric('sitesQuantity', array(
            'maxlength' => 11,
            'min' => 0,
            'placeholder' => 'Cantidad de sitios permitidos en la cuenta',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'sitesQuantity'
        )));
        
        $this->add(new Check('sendSMS', array(
            'value' => 1,
            'id' => 'sendSMS',
            'class' => 'onoffswitch-checkbox',
        )));
        
        $this->add(new Check('sendSMSAuto', array(
            'value' => 1,
            'id' => 'sendSMSAuto',
            'class' => 'onoffswitch-checkbox'
        )));
        
        $this->add(new Check('quickView', array(
            'value' => 1,
            'id' => 'quickView',
            'class' => 'onoffswitch-checkbox'
        )));
        
        $this->add(new Check('exportContact', array(
            'value' => 1,
            'id' => 'exportContact',
            'class' => 'onoffswitch-checkbox'
        )));
        
        $this->add(new Numeric('price', array(
            'maxlength' => 100,
            'type' => 'number',
            'min' => 0,
            'step' => 'any',
            'placeholder' => 'Valor en Colombia',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'price'
        )));
        
        $this->add(new Check('status', array(
            'value' => 1,
            'id' => 'status',
            'class' => 'onoffswitch-checkbox'
        )));
    }
}
