<?php

class SurveyController extends ControllerBase {
    public function indexAction() {
      
    }
    
    public function newAction() {
      if ($this->request->isPost()) {
        $this->logger->log("LALA");
      }
    }
    
    public function finishAction() {
      
    }
}