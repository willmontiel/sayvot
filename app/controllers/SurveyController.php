<?php

class SurveyController extends ControllerBase {
    public function indexAction() {
      
    }
    
    public function newAction() {
      if ($this->request->isPost()) {
    
    
        $content = $this->getRequestContent();
        
        $this->logger->log($content);
      }
      
    }
    
    public function finishAction() {
      
    }
}