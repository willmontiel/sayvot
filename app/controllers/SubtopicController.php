<?php

class SubtopicController extends ControllerBase {

  public function indexAction($idSubject) {
    $subject = Subject::findFirst(array("conditions" => "idSubject = ?0", "bind" => array($idSubject)));
    $this->validateModel($subject, "No se encontró el tema", "subject");
    
    $currentPage = (int) $_GET["page"];

    $builder = $this->modelsManager->createBuilder()
            ->from('Subtopic')
            ->where('Subtopic.idSubject = :idSubject:', array('idSubject' => $idSubject))
            ->orderBy('Subtopic.createdon');

    $this->view->setVar("page", $this->getPaginationWithQueryBuilder($builder, $currentPage));
    $this->view->setVar("subject", $subject);
  }

  public function addAction($idSubject) {
    $subject = Subject::findFirst(array("conditions" => "idSubject = ?0", "bind" => array($idSubject)));
    $this->validateModel($subject, "No se encontró el tema", "subject");
    
    $form = new SubtopicForm();

    $this->view->setVar("form", $form);
    $this->view->setVar("subject", $subject);

    if ($this->request->isPost()) {
      try {
        $subtopic = new Subtopic();
        $form->bind($this->request->getPost(), $subtopic);
        $status = $form->getValue('status');
        $subtopic->status = (empty($status) ? 0 : 1);
        $subtopic->idSubject = $subject->idSubject;

        if ($this->saveModelWithFormValidation($form, $subtopic, "Se ha creado el sub-tema exitosamente")) {
          return $this->response->redirect("subtopic/index/{$subject->idSubject}");
        }
      } catch (InvalidArgumentException $ex) {
        $this->flashSession->error($ex->getMessage());
      } catch (Exception $ex) {
        $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
        $this->logger->log("Exception while creating subtopic: " . $ex->getMessage());
        $this->logger->log($ex->getTraceAsString());
      }
    }
  }
  
  public function updateAction($id) {
    $subtopic = Subtopic::findFirst(array("conditions" => "idSubtopic = ?0", "bind" => array($id)));
    $this->validateModel($subtopic, "No se encontró el sub-tema", "subject");
    
    $form = new SubtopicForm($subtopic);
    $this->view->setVar("form", $form);
    $this->view->setVar("subtopic", $subtopic);
    if ($this->request->isPost()) {
      try {
        $form->bind($this->request->getPost(), $subtopic);
        
//        $status = $this->request->getPost('status');
        $status = $form->getValue('status');
        $subtopic->status = (empty($status) ? 0 : 1);
        
        if ($this->updateModelWithFormValidation($form, $subtopic, "Se ha editado el sub-tema exitosamente")) {
          return $this->response->redirect("subtopic/index/{$subtopic->idSubject}");
        }
      } catch (InvalidArgumentException $ex) {
        $this->flashSession->error($ex->getMessage());
      } catch (Exception $ex) {
        $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
        $this->logger->log("Exception while updating subtopic: " . $ex->getMessage());
        $this->logger->log($ex->getTraceAsString());
      }
    }
  }
}