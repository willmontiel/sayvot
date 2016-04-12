<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Email,
    Phalcon\Forms\Element\Password;

class LoginForm extends Form {
    public function initialize() {
        $this->add(new Email('email', array(
            'maxlength' => 100,
            'type' => 'email',
            'placeholder' => 'Dirección de correo eléctronico',
            'required' => 'required',
            'autofocus' => 'autofocus',
            'class' => 'form-control',
            'id' => 'email'
        )));
        
        $this->add(new Password('password', array(
            'maxlength' => 100,
            'type' => 'text',
            'placeholder' => 'Contraseña',
            'required' => 'required',
            'class' => 'form-control',
            'id' => 'pass1'
        )));
    }
}