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
    $this->hasMany("idSubtopicContent", "Survey", "idSubtopicContent");
  }

  public function getSource() {
    return "subtopiccontent";
  }

}
