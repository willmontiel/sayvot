<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Email,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Check;

class AccountForm extends Form {
    public function initialize() {
        $this->add(new Select('idCountry', Country::find(), array(
            'using' => array('idCountry', 'name'),
            'class' => 'select2 form-control',
            'required' => 'required',
            'autofocus' => "autofocus",
            'id' => 'countries_id'
        )));
        
        $this->add(new Text('name', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Nombre de la cuenta',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'name'
        )));
        
        $this->add(new Text('nit', array(
            'maxlength' => 20,
            'type' => 'text',
            'placeholder' => 'NIT',
            'class' => 'form-control',
            'id' => 'nit'
        )));
        
        $this->add(new Email('email', array(
            'maxlength' => 100,
            'type' => 'email',
            'placeholder' => 'Dirección de correo eléctronico',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'email'
        )));
        
        $this->add(new Text('phone', array(
            'maxlength' => 30,
            'type' => 'text',
            'placeholder' => 'Número de télefono o celular',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'phone'
        )));
        
        $this->add(new Text('address', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Dirección',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'phone'
        )));
        
        $this->add(new Select('city', City::find(), array(
            'using' => array('name', 'name'),
            'class' => 'select2 form-control',
            'required' => 'required',
            'autofocus' => "autofocus",
            'id' => 'city'
        )));
		
        $this->add(new Check('status', array(
            'value' => 1,
            'id' => 'status',
            'class' => 'onoffswitch-checkbox', 
            'id' => 'status'
        )));		
    }
}