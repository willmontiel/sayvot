<?php

class PriceplanController extends ControllerBase {
    public function IndexAction() {
        $currentPage = (int) $_GET["page"];
        
        $currency = Priceplan::find();
        
        // Create a Model paginator, show 10 rows by page starting from $currentPage
        $paginator   = new Phalcon\Paginator\Adapter\Model(
            array(
                "data"  => $currency,
                "limit" => self::DEFAULT_LIMIT,
                "page"  => $currentPage
            )
        );

        // Get the paginated results
        $page = $paginator->getPaginate();
        
        $this->view->setVar("page", $page);
    }
    
    public function AddAction() {
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
            }
        }
    }
    
    public function UpdateAction($id) {
        $currency = Currency::findFirst( array(
            'conditions' => "idcurrency = ?0",
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
    
    public function RemoveAction($id) {
        $currency = Currency::findFirst(array(
            'conditions' => "idcurrency = ?0",
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
    
    public function DeactivateAction() {
        
    }
}