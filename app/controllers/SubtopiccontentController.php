<?php

class SubtopiccontentController extends ControllerBase {
  public function indexAction($idSubtopic) {
    $subtopic = Subtopic::findFirst(array("conditions" => "idSubtopic = ?0", "bind" => array($idSubtopic)));
    $this->validateModel($subtopic, "No se encontró el sub-tema", "subject");
    
    $currentPage = (int) $_GET["page"];

    $builder = $this->modelsManager->createBuilder()
            ->from('SubtopicContent')
            ->where('SubtopicContent.idSubtopic = :idSubtopic:', array('idSubtopic' => $idSubtopic))
            ->orderBy('SubtopicContent.createdon');

    $this->view->setVar("page", $this->getPaginationWithQueryBuilder($builder, $currentPage));
    $this->view->setVar("subtopic", $subtopic);
  }
  
  public function addAction($idSubtopic) {
    $subtopic = Subtopic::findFirst(array("conditions" => "idSubtopic = ?0", "bind" => array($idSubtopic)));
    $this->validateModel($subtopic, "No se encontró el sub-tema", "subject");
    
    $form = new SubtopicContentForm();

    $this->view->setVar("form", $form);
    $this->view->setVar("subtopic", $subtopic);

    if ($this->request->isPost()) {
      try {
        $subtopicContent = new SubtopicContent();
        $form->bind($this->request->getPost(), $subtopicContent);
        $status = $form->getValue('status');
        $subtopicContent->status = (empty($status) ? 0 : 1);
        $subtopicContent->idSubtopic = $subtopic->idSubtopic;

        if ($this->saveModelWithFormValidation($form, $subtopicContent, "Se ha creado el contenido del sub-tema exitosamente")) {
          return $this->response->redirect("subtopiccontent/index/{$subtopic->idSubtopic}");
        }
      } catch (InvalidArgumentException $ex) {
        $this->flashSession->error($ex->getMessage());
      } catch (Exception $ex) {
        $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
        $this->logger->log("Exception while creating subtopic content: " . $ex->getMessage());
        $this->logger->log($ex->getTraceAsString());
      }
    }
  }
  
  public function updateAction($id) {
    $subtopicContent = SubtopicContent::findFirst(array("conditions" => "idSubtopicContent = ?0", "bind" => array($id)));
    $this->validateModel($subtopicContent, "No se encontró el contenido del sub-tema", "subject");
    
    $form = new SubtopicContentForm();
    $this->view->setVar("form", $form);
    $this->view->setVar("subtopicContent", $subtopicContent);
    if ($this->request->isPost()) {
      try {
        $form->bind($this->request->getPost(), $subtopicContent);
        
//        $status = $this->request->getPost('status');
        $status = $form->getValue('status');
        $subtopicContent->status = (empty($status) ? 0 : 1);
        
        if ($this->updateModelWithFormValidation($form, $subtopicContent, "Se ha editado el contenido del sub-tema exitosamente")) {
          return $this->response->redirect("subtopiccontent/index/{$subtopicContent->idSubtopic}");
        }
      } catch (InvalidArgumentException $ex) {
        $this->flashSession->error($ex->getMessage());
      } catch (Exception $ex) {
        $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
        $this->logger->log("Exception while updating subtopic content: " . $ex->getMessage());
        $this->logger->log($ex->getTraceAsString());
      }
    }
  }
}

