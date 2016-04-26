<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Email,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Check;

class AccountForm extends Form {
    public function initialize() {
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
        
        $countries = array("" => "Seleccione una opción");
        foreach (Country::find() as $country) {
            $countries[$country->idCountry] = $country->name;
        }
        
        $this->add(new Select('idCountry', $countries, array(
            'class' => 'form-control',
            'required' => 'required',
        )));
        
        $this->add(new Select('state', array(), array(
            'class' => 'form-control',
            'required' => 'required',
        )));
        
        $this->add(new Select('city', array(), array(
            'class' => 'form-control',
            'required' => 'required',
        )));
        
        $this->add(new Text('accountName', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Nombre de la cuenta',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'name'
        )));
        
        $this->add(new Email('accountEmail', array(
            'maxlength' => 100,
            'type' => 'email',
            'placeholder' => 'Dirección de correo eléctronico',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'email'
        )));
        
        $this->add(new Text('accountPhone', array(
            'maxlength' => 30,
            'type' => 'text',
            'placeholder' => 'Número de télefono o celular',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'phone'
        )));
        
        $this->add(new Text('accountAddress', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Dirección',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'phone'
        )));
        
        $this->add(new Select('idAccountplan', array(
            
        )));
        
        
        $accounttypes = array("" => "Seleccione una opción");
        foreach (Accounttype::find() as $accounttype) {
            $accounttypes[$accounttype->idAccounttype] = $accounttype->name;
        }
        $this->add(new Select('idAccounttype', $accounttypes, array(
            'class' => 'select2 form-control',
            'required' => 'required',
        )));
        
        $this->add(new Check('status', array(
            'value' => 1,
            'id' => 'status',
            'class' => 'onoffswitch-checkbox', 
            'id' => 'status'
        )));
    }
}
