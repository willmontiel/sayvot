<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Email,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Password,
    Phalcon\Forms\Element\Check;

class UserForm extends Form {
    public function initialize() {
        $this->add(new Text('name', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Nombres',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'name'
        )));
        
        
        $this->add(new Text('lastname', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Apellidos',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'lastname'
        )));
        
        $this->add(new Select('idCountry', Country::find(), array(
            'using' => array('idCountry', 'name'),
            'class' => 'form-control',
            'required' => 'required',
            'autofocus' => "autofocus",
            'id' => 'idCountry'
        )));
        
        $this->add(new Check('agree', array(
            'value' => 1,
            'id' => 'agree',
            'class' => 'onoffswitch-checkbox', 
            'id' => 'agree'
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
        
        $this->add(new Check('status', array(
            'value' => 1,
            'id' => 'status',
            'class' => 'onoffswitch-checkbox', 
            'id' => 'status'
        )));
        
        $this->add(new Text('username', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Nombre de usuario',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'username'
        )));
        
        $this->add(new Password('pass1', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Contraseña',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'pass1'
        )));
        
        $this->add(new Password('pass2', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Repite la contraseña',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'pass2'
        )));
    }
}
