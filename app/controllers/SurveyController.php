<?php

class SurveyController extends ControllerBase {

  public function indexAction() {
    
  }

  public function newAction() {
    if ($this->request->isPost()) {
      try {
        $contentsraw = $this->getRequestContent();
        $data = json_decode($contentsraw);

        $wrapper = new \Sayvot\Wrappers\SurveyWrapper();
        $wrapper->setData($data);
        $wrapper->createSurvey();

        return $this->setJsonResponse(array("message" => "Se ha creado la encuesta exitosamente"), 200);
      } catch (InvalidArgumentException $ex) {
        return $this->setJsonResponse(array('message' => $ex->getMessage()), 400);
      } catch (Exception $ex) {
        $this->logger->log("Exception while finding contactlist... {$ex}");
        return $this->setJsonResponse(array('message' => 'Ha ocurrido un error, por favor contacte al soporte'), 500, 'Ha ocurrido un error');
      }
    }
  }

  public function finishAction() {
    
  }

}
