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
        
        $this->add(new Check('agree', array(
            'value' => 1,
            'id' => 'agree',
            'class' => '', 
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

        $this->add(new Select('gender', 
            array(
                "male" => "M",
                "female" => "F"
            )
        ));

        $this->add(new Text('twitter', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Link a cuenta de twitter',
            'class' => 'form-control',
            'id' => 'twitter'
        )));

        $this->add(new Text('facebook', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Link a cuenta de facebook',
            'class' => 'form-control',
            'id' => 'facebook'
        )));
        
        $this->add(new Text('institute', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Colegio/Instituto o Universidad',
            'class' => 'form-control',
            'id' => 'institute'
        )));
    }
}
