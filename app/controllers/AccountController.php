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
    
    public function paymentdataAction($idAccount) {
        try {
            $account = Account::findFirstByIdAccount($idAccount);
            
            if (!$account) {
                throw new InvalidArgumentException("Esta cuenta, ya ha sido configurada con datos de pago");
            }
            
            if (Paymentdata::findFirstByIdAccount($account->idAccount)) {
                throw new InvalidArgumentException("Esta cuenta, ya ha sido configurada con datos de pago");
            }
            
            $paymentForm = new PaymentdataForm($account);
            $this->view->paymentForm = $paymentForm;
            $this->view->setVar("account", $account);
            
            if ($this->request->isPost()) {
                $this->db->begin();
                $payment = new Paymentdata();
                $paymentForm->bind($this->request->getPost(), $payment);
                
                $payment->idAccount = $account->idAccount;
                $payment->status = 1;
                
                if (!$payment->save()) {
                    foreach ($payment->getMessages() as $msg) {
                        $m .= $msg . "<br>";
                    }
                    $this->flashSession->error($m);
                }
                else {
                  $account->confirm = 1;
                  if ($account->save()) {
                      $this->db->commit();
                      $this->flashSession->success("Se ha activado la cuenta exitosamente");
                      return $this->response->redirect("session/login");
                  }
                  
                  foreach ($account->getMessages() as $msg) {
                      $m .= $msg . "<br>";
                  }
                  $this->flashSession->error($m);
                }
            }
            
        } 
        catch (InvalidArgumentException $ex) {
            $this->db->rollback();
            $this->flashSession->error($ex->getMessage());
            return $this->response->redirect("error");
        }
        catch (Exception $ex) {
            $this->logger->log("Exception while verify account: {$ex->getMessage()}");
            $this->logger->log($ex->getTraceAsString());
            $this->flashSession->error($ex->getMessage());
            return $this->response->redirect("error");
        }
    }
    
    public function verifyAction($code) {
        try {
            $pe = new \Sayvot\Misc\ParametersEncoder();
            $parameters = $pe->decodeLink("account/verify", $code);
            
            $account = Account::findFirstByIdAccount($parameters[0]);
            
            if (!$account) {
                throw new \InvalidArgumentException('No existe una cuenta con el id ingresado');
            }
            
            $user = User::findFirstByIdUser($parameters[1]);
            
            if (!$user) {
                throw new \InvalidArgumentException('No existe un usuario con el id ingresado');
            }
            
            if ($user->idAccount != $account->idAccount) {
                throw new \InvalidArgumentException('No existe un usuario con el id ingresado');
            }
            
            if (($account->accountplan->price + 0) != 0) {
                return $this->response->redirect("account/paymentdata/{$account->idAccount}");
            }
            
            $account->confirm = 1;
            
            if ($account->save()) {
                return $this->response->redirect("session/login");
            }
        } 
        catch (InvalidArgumentException $ex) {
            $this->flashSession->error($ex->getMessage());
            return $this->response->redirect("error");
        }
        catch (Exception $ex) {
            $this->logger->log("Exception while verify account: {$ex->getMessage()}");
            $this->logger->log($ex->getTraceAsString());
            $this->flashSession->error($ex->getMessage());
            return $this->response->redirect("error");
        }
    }
}
