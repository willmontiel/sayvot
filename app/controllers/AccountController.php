<?php

class AccountController extends ControllerBase {
    public function IndexAction() {
        
    }
    
    public function AddAction() {
        $account = new Account();
        $accountForm = new AccountForm($account);
	$this->view->accountForm = $accountForm;	
        
        if ($this->request->isPost()) {
            try {
                $accountForm->bind($this->request->getPost(), $account);
                $status = $accountForm->getValue('status');
                $account->status = (empty($status) ? 0 : 1);

                if ($this->saveModel($account, "Se ha creado la cuenta exitosamente")) {
                    return $this->response->redirect("accounts");
                }
            } 
            catch (InvalidArgumentException $ex) {
                $this->flashSession->error($ex->getMessage());
            }
            catch (Exception $ex) {
                $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
                $this->logger->log("Exception while creating currency: " . $ex->getTraceAsString());
            }
        }
    }
    
    public function UpdateAction() {
        
    }
    
    public function DeactivateAction() {
        
    }
}
