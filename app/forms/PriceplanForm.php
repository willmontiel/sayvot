<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Numeric,
    Phalcon\Forms\Element\Check;

class PriceplanForm extends Form {
    public function initialize() {
        $this->add(new Numeric('price', array(
            'maxlength' => 100,
            'type' => 'number',
            'min' => 0,
            'step' => 'any',
            'placeholder' => 'Valor en Colombia',
            'required' => 'required',
            'autofocus' => "autofocus",
            'class' => 'form-control',
            'id' => 'value'
        )));
		
        $this->add(new Check('status', array(
            'value' => 1,
            'id' => 'status'
        )));	
        
        $this->add(new Select('idcurrency', Currency::find(), array(
             'using' => array('idcurrency', 'name'),
             'class' => 'form-control select2',
             'required' => 'required'
         )));
    }
}
