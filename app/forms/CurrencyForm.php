<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element,
    Phalcon\Forms\Element\TextArea,
    Phalcon\Forms\Element\Check;

class CurrencyForm extends Form {
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
        
        $this->add(new Text('code', array(
            'maxlength' => 10,
            'type' => 'text',
            'placeholder' => 'Código',
            'required' => 'required',
            'autofocus' => "autofocus",
            'class' => 'form-control',
            'id' => 'code'
        )));
        
        $this->add(new Text('simbol', array(
            'maxlength' => 2,
            'type' => 'text',
            'placeholder' => 'Simbolo',
            'required' => 'required',
            'autofocus' => "autofocus",
            'class' => 'form-control',
            'id' => 'simbol'
        )));
		
        $this->add(new Check('status', array(
            'value' => 1,
            'id' => 'status'
        )));		
    }
}
