<?php

class BaseModel extends \Phalcon\Mvc\Model {

  public function initialize() {
    $this->useDynamicUpdate(true);
  }

  public function beforeValidationOnCreate() {
    $this->createdon = time();
    $this->updatedon = time();
    
    if (isset($this->description)) {
      $this->description = trim($this->description);
      $this->description = (empty($this->description) ? "Sin descripción" : $this->description);
    }
  }

  public function beforeValidationOnUpdate() {
    $this->updatedon = time();
    
    if (isset($this->description)) {
      $this->description = trim($this->description);
      $this->description = (empty($this->description) ? "Sin descripción" : $this->description);
    }
  }

}
