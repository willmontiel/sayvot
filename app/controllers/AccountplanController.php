<?php

class AccountplanController extends ControllerBase {
    public function IndexAction() {
        $currentPage = (int) $_GET["page"];
        
        $builder = $this->modelsManager->createBuilder()
            ->from('Accountplan')
            ->leftJoin('Country')
            ->leftJoin('Currency', 'Currency.idCurrency = Country.idCurrency')
            ->orderBy('Accountplan.createdon');
        
        $this->view->setVar("page", $this->getPaginationWithQueryBuilder($builder, $currentPage));
    }
    
    public function addAction() {
        $accountPlan = new Accountplan();
        $accountPlanForm = new AccountplanForm($accountPlan);
	$this->view->accountPlanForm = $accountPlanForm;	
        
        if ($this->request->isPost()) {
            try {
                $accountPlanForm->bind($this->request->getPost(), $accountPlan);
                
                $accountPlan->status = $this->validateBoolean($accountPlanForm->getValue('status'));
                $accountPlan->advertising = $this->validateBoolean($accountPlanForm->getValue('advertising'));
                $accountPlan->sendSMSAuto = $this->validateBoolean($accountPlanForm->getValue('sendSMSAuto'));
                $accountPlan->sendSMS = $this->validateBoolean($accountPlanForm->getValue('sendSMS'));
                $accountPlan->quickView = $this->validateBoolean($accountPlanForm->getValue('quickView'));
                $accountPlan->exportContact = $this->validateBoolean($accountPlanForm->getValue('exportContact'));
                $accountPlan->sitesQuantity = $this->validateNumber($accountPlanForm->getValue('sitesQuantity'));
                $accountPlan->surveyQuantity = $this->validateNumber($accountPlanForm->getValue('surveyQuantity'));
                $accountPlan->questionQuantity = $this->validateNumber($accountPlanForm->getValue('questionQuantity'));
                $accountPlan->userQuantity = $this->validateNumber($accountPlanForm->getValue('userQuantity'));

                if ($this->saveModel($accountPlan, "Se ha creado el plan de pago exitosamente")) {
                    return $this->response->redirect("accountplan");
                }
            } 
            catch (InvalidArgumentException $ex) {
                $this->flashSession->error($ex->getMessage());
            }
            catch (Exception $ex) {
                $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
                $this->logger->log("Exception while creating accountplan: " . $ex->getTraceAsString());
            }
        }
    }
    
    public function updateAction($id) {
        $accountplan = Accountplan::findFirst( array(
            'conditions' => "idAccountplan = ?0",
            'bind' => array($id)
        ));
        
        $this->validateModel($accountplan, "No existe un plan de pago con el id: {$id}", "accountplan");
        
        $accountplanForm = new AccountplanForm($accountplan);
	$this->view->accountPlanForm = $accountplanForm;
        $this->view->setVar("accountplan", $accountplan);
        
        if ($this->request->isPost()) {
            try {
                $accountplanForm->bind($this->request->getPost(), $accountplan);
                
                $accountPlan->status = $this->validateBoolean($accountplanForm->getValue('status'));
                $accountPlan->advertising = $this->validateBoolean($accountplanForm->getValue('advertising'));
                $accountPlan->sendSMSAuto = $this->validateBoolean($accountplanForm->getValue('sendSMSAuto'));
                $accountPlan->sendSMS = $this->validateBoolean($accountplanForm->getValue('sendSMS'));
                $accountPlan->quickView = $this->validateBoolean($accountplanForm->getValue('quickView'));
                $accountPlan->exportContact = $this->validateBoolean($accountplanForm->getValue('exportContact'));
                $accountPlan->sitesQuantity = $this->validateNumber($accountplanForm->getValue('sitesQuantity'));
                $accountPlan->surveyQuantity = $this->validateNumber($accountplanForm->getValue('surveyQuantity'));
                $accountPlan->questionQuantity = $this->validateNumber($accountplanForm->getValue('questionQuantity'));
                $accountPlan->userQuantity = $this->validateNumber($accountplanForm->getValue('userQuantity'));

                if ($this->saveModel($accountplan, "Se ha editado la el plan de pago <em><strong>{$accountplan->name}</strong></em> exitosamente")) {
                    return $this->response->redirect("accountplan");
                }
            }
            catch (InvalidArgumentException $ex) {
                $this->flashSession->error($ex->getMessage());
            }
            catch (Exception $ex) {
                $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
                $this->logger->log("Exception while updating accountplan : " . $ex->getTraceAsString());
            }
        }
    }
    
    public function removeAction($id) {
        $accountplan = Accountplan::findFirst(array(
            'conditions' => "idAccountplan = ?0",
            'bind' => array($id)
        ));
        
        $this->validateModel($accountplan, "No existe un plan de pago con el id: {$id}", "accountplan");
        
        try {
            $this->deleteModel($accountplan, "Se ha eliminado el plan de pago <em><strong>{$accountplan->name}</strong></em> exitosamente");
        } 
        catch (InvalidArgumentException $ex) {
            $this->flashSession->error($ex->getMessage());
        }
        catch (Exception $ex) {
            $this->logger->log("Exception while deleting accountplan: " . $ex->getTraceAsString());
            $this->flashSession->error("No ha sido posible eliminar el plan de pago, por favor contacta al administrador");
        }
        
        return $this->response->redirect("accountplan");
    }
    
    public function deactivateAction() {
        
    }
    
    public function getplansbycountryAction($idCountry) {
        $aps = Accountplan::find(array("conditions" => "idCountry = ?0", "bind" => array($idCountry)));
        $accountplans = array();
        
        foreach ($aps as $value) {
            $obj = new stdClass();
            $obj->id = $value->idAccountplan;
            $obj->text = $value->name;
            
            $accountplans[] = $obj;
        }
        
        return $this->setJsonResponse($accountplans, 200);
    }
    
    public function getplandataAction($idAccountplan) {
        $aps = $this->modelsManager->createBuilder()
            ->from('Accountplan')
            ->leftJoin('Country')
            ->leftJoin('Currency', 'Currency.idCurrency = Country.idCurrency')
            ->where('Accountplan.idAccountplan = :idAccountplan:', array('idAccountplan' => $idAccountplan))
            ->getQuery()
            ->execute();
        
        $accountplan = array();
        
        foreach ($aps as $ap) {
            $price = $ap->price + 0;
            $accountplan['idAccounplan'] = $ap->idAccountplan;
            $accountplan['name'] = $ap->name;
            $accountplan['price'] = $ap->country->currency->simbol . $price;
            $accountplan['currency'] = $ap->country->currency->name;
            $accountplan['surveyQuantity'] = $ap->surveyQuantity;
            $accountplan['questionQuantity'] = $ap->questionQuantity;
            $accountplan['userQuantity'] = $ap->userQuantity;
            $accountplan['advertising'] = $ap->advertising;
            $accountplan['sendSMSAuto'] = $ap->sendSMSAuto;
            $accountplan['sitesQuantity'] = $ap->sitesQuantity;
            $accountplan['sendSMS'] = $ap->sendSMS;
            $accountplan['exportContact'] = $ap->exportContact;
        }
        
        sleep(4);
        
        return $this->setJsonResponse($accountplan, 200);
    }
}
