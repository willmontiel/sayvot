<?php

class Subtopic extends BaseModel {
    public $idSubtopic;
    public $idSubject;
    public $status;
    public $createdon;
    public $updatedon;
    public $name;
    public $description;
    
    public function initialize() {
        $this->belongsTo("idSubject", "Subject", "idSubject");
        $this->hasMany("idSubtopic", "SubtopicContent", "idSubtopic");
    }
}
