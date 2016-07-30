<?php

class Survey extends BaseModel {

  public $idSurvey;
  public $idSubtopicContent;
  public $idAccount;
  public $createdon;
  public $updatedon;
  public $name;
  public $status;
  public $wizardOption;

  public function initialize() {
    $this->belongsTo("idAccount", "Account", "idAccount");
    $this->belongsTo("idSubtopicContent", "SubtopicContent", "idSubtopicContent");
    //$this->hasMany("idSubtopic", "SubtopicContent", "idSubtopic");
  }

}
