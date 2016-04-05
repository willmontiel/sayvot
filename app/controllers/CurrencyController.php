<?php

class CurrencyController extends ControllerBase {
    public function IndexAction() {
        $currentPage = (int) $_GET["page"];
        $this->view->setVar("page", $this->getPaginationWithModel(Currency::find(), $currentPage));
    }
    
    public function addAction() {
        $currency = new Currency();
        $currencyForm = new CurrencyForm($currency);
	$this->view->currencyForm = $currencyForm;	
        
        if ($this->request->isPost()) {
            try {
                $currencyForm->bind($this->request->getPost(), $currency);
                $status = $currencyForm->getValue('status');
                $currency->status = (empty($status) ? 0 : 1);

                if ($this->saveModel($currency, "Se ha creado el tipo de moneda exitosamente")) {
                    return $this->response->redirect("currency");
                }
            } 
            catch (InvalidArgumentException $ex) {
                $this->flashSession->error($ex->getMessage());
            }
            catch (Exception $ex) {
                $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
                $this->logger->log("Exception while creating currency: " . $ex->getTraceAsString());
                $this->logger->log($ex->getTraceAsString());
            }
        }
    }
    
    public function updateAction($id) {
        $currency = Currency::findFirst( array(
            'conditions' => "idCurrency = ?0",
            'bind' => array($id)
        ));
        
        $this->validateModel($currency, "No existe un tipo de moneda con el id: {$id}", "currency");
        
        $currencyForm = new CurrencyForm($currency);
	$this->view->currencyForm = $currencyForm;
        $this->view->setVar("currency", $currency);
        
        if ($this->request->isPost()) {
            try {
                $currencyForm->bind($this->request->getPost(), $currency);
                $status = $currencyForm->getValue('st');
                $currency->status = (empty($status) ? 0 : 1);

                if ($this->saveModel($currency, "Se ha editado la moneda <em><strong>{$currency->name}</strong></em> exitosamente")) {
                    return $this->response->redirect("currency");
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
    
    public function removeAction($id) {
        $currency = Currency::findFirst(array(
            'conditions' => "idCurrency = ?0",
            'bind' => array($id)
        ));
        
        $this->validateModel($currency, "No existe un tipo de moneda con el id: {$id}", "currency");
        
        try {
            $this->deleteModel($currency, "Se ha eliminado el tipo de moneda <em><strong>{$currency->name}</strong></em> exitosamente");
        } 
        catch (InvalidArgumentException $ex) {
            $this->flashSession->error($ex->getMessage());
        }
        catch (Exception $ex) {
            $this->logger->log("Exception while deleting currency: " . $ex->getTraceAsString());
            $this->flashSession->error("No ha sido posible eliminar el tipo de moneda, por favor contacta al administrador");
        }
        
        return $this->response->redirect("currency");
    }
}