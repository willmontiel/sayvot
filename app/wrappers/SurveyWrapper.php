<?php

namespace Sayvot\Wrappers;

class SurveyWrapper {
  public $data = null;
  protected $logger;
  protected $user;


  public function __construct() {
    $this->logger = \Phalcon\DI::getDefault()->get('logger');
  }
  
  public function setData($data) {
    $this->data = $data;
  }
  
  public function setUser(\User $user) {
    $this->user = $user;
  }


  public function createSurvey() {
    $this->validateSubtopicContent();
    $name = trim($this->data->name);
    if (empty($name)) {
      throw new \InvalidArgumentException("Debes enviar un nombre valido para la encuesta, debe contener entre 2 y 80 caracteres");
    }
    
    $survey = new \Survey();
    $survey->idAccount = 1;
    $survey->wizardOption = "draft";
    $survey->name = $name;
    $survey->idSubtopicContent = $this->data->subtopicContent;
    
    if (!$survey->save()) {
      foreach ($survey->getMessages() as $msg) {
        $this->logger->log("Error while saving survey draft: {$msg}");
      }
      throw new \InvalidArgumentException("Ocurrió un error mientras se guardaba la encuenta: {$msg}}");
    }
  }
  
  public function validateSubtopicContent() {
    $subtopicContent = \SubtopicContent::findFirst(array(
        "bind" => "idSubtopicContent = ?0",
        "conditions" => array($this->data->subtopicContent)
    ));
    
    if (!$subtopicContent) {
      throw new \InvalidArgumentException("El contenido del sub-tema elegido, ya no existe, por favor valida la información");
    }
  }
}
