<?php

class SubtopicContent extends BaseModel {

  public $idSubtopicContent;
  public $idSubtopic;
  public $status;
  public $createdon;
  public $updatedon;
  public $name;
  public $description;

  public function initialize() {
    $this->belongsTo("idSubtopic", "Subtopic", "idSubtopic");
  }

  public function getSource() {
    return "subtopiccontent";
  }

}
