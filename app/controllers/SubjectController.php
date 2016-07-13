<?php

class SubjectController extends ControllerBase {

  public function indexAction() {
    $currentPage = (int) $_GET["page"];

    $builder = $this->modelsManager->createBuilder()
            ->from('Subject')
            ->orderBy('Subject.createdon');

    $this->view->setVar("page", $this->getPaginationWithQueryBuilder($builder, $currentPage));
  }

  public function addAction() {
    $form = new SubjectForm();

    $this->view->setVar("form", $form);

    if ($this->request->isPost()) {
      try {
        $subject = new Subject();
        $form->bind($this->request->getPost(), $subject);
        $status = $form->getValue('status');
        $subject->status = (empty($status) ? 0 : 1);

        if ($this->saveModelWithFormValidation($form, $subject, "Se ha creado el tema exitosamente")) {
          return $this->response->redirect("subject");
        }
      } catch (InvalidArgumentException $ex) {
        $this->flashSession->error($ex->getMessage());
      } catch (Exception $ex) {
        $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
        $this->logger->log("Exception while creating subject: " . $ex->getMessage());
        $this->logger->log($ex->getTraceAsString());
      }
    }
  }
  
  public function updateAction($id) {
    $subject = Subject::findFirst(array("conditions" => "idSubject = ?0", "bind" => array($id)));
    
    $this->validateModel($subject, "No se encontró el tema", "subject");
    
    $form = new SubjectForm($subject);
    $this->view->setVar("form", $form);
    $this->view->setVar("subject", $subject);
    if ($this->request->isPost()) {
      try {
        $form->bind($this->request->getPost(), $subject);
        
//        $status = $this->request->getPost('status');
        $status = $form->getValue('status');
        $subject->status = (empty($status) ? 0 : 1);
        
        if ($this->updateModelWithFormValidation($form, $subject, "Se ha editado el tema exitosamente")) {
          return $this->response->redirect("subject");
        }
      } catch (InvalidArgumentException $ex) {
        $this->flashSession->error($ex->getMessage());
      } catch (Exception $ex) {
        $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
        $this->logger->log("Exception while updating subject: " . $ex->getMessage());
        $this->logger->log($ex->getTraceAsString());
      }
    }
  }
}