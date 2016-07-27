<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Check,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\TextArea;
use Phalcon\Validation\Validator\StringLength;
use Sayvot\Validators\SpaceValidatorForm;

class SubtopicContentForm extends Form {

  public function initialize($entity = null, $options = array()) {
    $name = new Text('name', array(
        'maxlength' => 100,
        'placeholder' => 'Nombre del contenido del sub-tema',
        'required' => 'required',
        'class' => 'form-control',
        'autofocus' => 'autofocus',
        'id' => 'name',
    ));
    $name->setLabel("*Nombre del contenido del sub-tema");
    $name->addValidator(new SpaceValidatorForm(array('message' => 'El campo nombre se encuentra vacío')));
    $name->addValidator(new StringLength(array(
        'min' => 2, 
        'messageMinimum' => 'El nombre del contenido del sub-tema es demasiado corto, debe tener al menos 2 carateres',
        'max' => 800,
        'messageMaximum' => 'El nombre del contenido del sub-tema es demasiado largo, debe tener máximo 800 carateres',
    )));
    $this->add($name);
    
    $description = new TextArea('description', array(
        'maxlength' => 100,
        'placeholder' => 'Descripción',
        'class' => 'form-control',
        'rows' => 5,
        'id' => 'description'
    ));
    $description->setLabel("Descripción");
    $this->add($description);
    
    $checked = "checked";
    $value = "1";
    if ($entity) {
      $checked = ($entity->status ? "checked" : "");
      $value = $entity->status;
    }
    
    $status = new Check('status', array(
        'id' => 'status',
        'class' => 'onoffswitch-checkbox',
        "value" => $value,
        $checked => $checked,
    ));
    $status->setLabel("*Estado");
    $this->add($status);
  }

}
