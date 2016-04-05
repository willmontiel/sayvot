<?php

class AccountController extends ControllerBase {
    public function indexAction() {
        $currentPage = (int) $_GET["page"];
        
        $builder = $this->modelsManager->createBuilder()
            ->from('Account')
            ->leftJoin('Country')
            ->orderBy('Account.createdon');
        
        $this->view->setVar("page", $this->getPaginationWithQueryBuilder($builder, $currentPage));
    }
    
    public function addAction() {
        $account = new Account();
        $accountForm = new AccountForm($account);
	$this->view->accountForm = $accountForm;	
        
        if ($this->request->isPost()) {
            try {
                $accountForm->bind($this->request->getPost(), $account);
                $status = $accountForm->getValue('status');
                $account->status = 1;

                if ($this->saveModel($account, "Se ha creado la cuenta exitosamente")) {
                    return $this->response->redirect("account");
                }
            } 
            catch (InvalidArgumentException $ex) {
                $this->flashSession->error($ex->getMessage());
            }
            catch (Exception $ex) {
                $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
                $this->logger->log("Exception while creating account: " . $ex->getMessage());
                $this->logger->log($ex->getTraceAsString());
            }
        }
    }
    
    public function updateAction($id) {
        $account = Account::findFirst(array('conditions' => "idAccount = ?0", 'bind' => array($id)));
        $this->validateModel($account, "No existe una cuenta con el id: {$id}", "account");
        
        $accountForm = new AccountForm($account);
	$this->view->accountForm = $accountForm;
        $this->view->setVar("account", $account);
        
        if ($this->request->isPost()) {
            try {
                $accountForm->bind($this->request->getPost(), $account);
                $status = $accountForm->getValue('st');
                $account->status = (empty($status) ? 0 : 1);

                if ($this->saveModel($currency, "Se ha editado cuenta <em><strong>{$account->name}</strong></em> exitosamente")) {
                    return $this->response->redirect("account");
                }
            }
            catch (InvalidArgumentException $ex) {
                $this->flashSession->error($ex->getMessage());
            }
            catch (Exception $ex) {
                $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
                $this->logger->log($ex->getMessage());
                $this->logger->log("Exception while creating currency: " . $ex->getTraceAsString());
            }
        }
    }
    
    public function DeactivateAction() {
        
    }
}
