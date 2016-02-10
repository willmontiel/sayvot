<?php
/**
 * Description of ControllerBase
 *
 * @author Will
 */
class ControllerBase extends \Phalcon\Mvc\Controller {
    protected $_isJsonResponse = false;
    
    const START_PAGE = 1;
    const DEFAULT_LIMIT = 15;

    public function initialize() {
    //	if (isset($this->userObject)) {
            $this->user = $this->userObject;
    //	}
    }

    /**
     * Llamar este metodo para enviar respuestas en modo JSON
     * @param string $content
     * @param int $status
     * @param string $message
     * @return \Phalcon\Http\ResponseInterface
     */
    public function setJsonResponse($content, $status = 200, $message = '')  {
        $this->view->disable();

        $this->_isJsonResponse = true;
        $this->response->setContentType('application/json', 'UTF-8');

        if ($status != 200) {
                $this->response->setStatusCode($status, $message);
        }
        if (is_array($content)) {
                $content = json_encode($content);
        }
        $this->response->setContent($content);
        return $this->response;
    }
	
    /**
     * Lógica para rastros de auditoría 
     * @param string $controller
     * @param string $action
     * @param int $date
     * @param int $ip
     */
    protected function traceSuccess($msg) {
        $controller = $this->dispatcher->getControllerName();
        $action = $this->dispatcher->getActionName();
        $date = time();
        $ip = $_SERVER['REMOTE_ADDR'];

        $operation = $controller . '::' .$action;

        AuditTrace::createAuditTrace($this->user, 'Success', $operation, $msg, $date, $ip);
    }
	
    protected function traceFail($msg) {
        $controller = $this->dispatcher->getControllerName();
        $action = $this->dispatcher->getActionName();
        $date = time();
        $ip = $_SERVER['REMOTE_ADDR'];

        $operation = $controller . '::' .$action;

        AuditTrace::createAuditTrace($this->user, 'Fail', $operation, $msg, $date, $ip);
    }
	
    /**
     * Retorna el contenido POST de un Request desde 
     * un objeto inyectado o directamente desde el request
     */
    public function getRequestContent() {
        if($this->requestContent && isset($this->requestContent->content)) {
            return $this->requestContent->content;
        }
        else {
            return $this->request->getRawBody();
        }
    }
	
    public function getMessageResponse($status)  {
        $obj = new stdClass();

        switch ($status) {
            case 200:
                $obj->type = "success";
                $obj->msg = "Solicitud resuelta exitosamente";
                $obj->status = "200";
                break;

            case 500:
                $obj->type = "error";
                $obj->msg = "Ha ocurrido un error mientras se resolvía la solicitud, contacte al administrador";
                $obj->status = "500";
                break;

            case 400:
                $obj->type = "error";
                $obj->msg = "Solicitud incorrecta";
                $obj->status = "400";
                break;

            case 404:
                $obj->type = "error";
                $obj->msg = "Recurso no encontrado";
                $obj->status = "404";
                break;

            default:
                $obj->type = "success";
                $obj->msg = "error";
                $obj->status = 500;
                break;
        }

        return $obj;
    }
    
    protected function saveModel($model, $successMsg) {
        if ($model->save()) {
            $this->flashSession->success($successMsg);
            return true;
        }

        $m = "";
        foreach ($model->getMessages() as $msg) {
            $m .= $msg . "<br>";
        }

        throw new InvalidArgumentException($m);
    }
    
    protected function validateModel($model, $msg, $redirect) {
        if (!$model) {
            $this->flashSession->warning($msg);
            return $this->response->redirect($redirect);
        }
    }
    
    protected function deleteModel($model, $successMsg) {
        if ($model->delete()) {
            $this->flashSession->warning($successMsg);
            return true;
        }

        $m = "";
        foreach ($model->getMessages() as $msg) {
            $m .= $msg . "<br>";
        }

        throw new InvalidArgumentException($m);
    }
}

