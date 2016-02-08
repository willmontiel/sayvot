<?php

class CurrencyController extends ControllerBase {
    public function IndexAction() {
        $currentPage = (int) $_GET["page"];
        
        $currency = Currency::find();
        
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
            $currencyForm->bind($this->request->getPost(), $currency);
            $status = $currencyForm->getValue('status');
            $currency->status = (empty($status) ? 0 : $status);
            
            if ($currency->save()) {
                $this->flashSession->success("Se ha creado el tipo de moneda exitosamente");
                return $this->response->redirect("currency");
            }
            
            $m = "";
            foreach ($currency->getMessages() as $msg) {
                $m .= $msg . "<br>";
            }
            
            $this->flashSession->error($m);
        }
    }
    
    public function UpdateAction() {
        
    }
    
    public function RemoveAction() {
        
    }
    
    public function DeactivateAction() {
        
    }
}