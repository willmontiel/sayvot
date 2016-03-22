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
	
    /**
     * Guarda el modelo que le es pasado por párametro, y un mensaje en caso de exito en el flashSession, genera una Excepción en caso de error 
     * @param \Phalcon\Mvc\Model $model
     * @param String $successMsg
     * @return boolean
     * @throws InvalidArgumentException
     */
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
    
    /**
     * Valida si un modelo existe, en caso de que no carga el mensaje pasado por parametro en flashSession y redirige a la acción o controlador que ha sido
     * pasado como párametro
     * @param \Phalcon\Mvc\Model $model
     * @param String $msg
     * @param String $redirect
     * @return type
     */
    protected function validateModel($model, $msg, $redirect) {
        if (!$model) {
            $this->flashSession->warning($msg);
            return $this->response->redirect($redirect);
        }
    }
    
    /**
     * Elimina el modelo pasado por parametro y carga el mensaje que ha sido pasado por párametro en el flashSession,
     * En caso de error genera una excepción
     * @param \Phalcon\Mvc\Model $model
     * @param String $successMsg
     * @return boolean
     * @throws InvalidArgumentException
     */
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
    
    /**
     * Recibe como párametro un modelo y la página que se necesita, y retorna un objeto paginador de phalcon
     * @param \Phalcon\Mvc\Model $model
     * @param int $page
     * @return Phalcon\Paginator\Adapter\Model
     */
    protected function getPaginationWithModel($model, $page) {
        $paginator   = new Phalcon\Paginator\Adapter\Model( array(
            "data"  => $model,
            "limit" => self::DEFAULT_LIMIT,
            "page"  => $page
        ));

        return $paginator->getPaginate();
    }
    
    protected function getPaginationWithQueryBuilder($builder, $page) {
        $paginator = new Phalcon\Paginator\Adapter\QueryBuilder( array(
            "builder" => $builder,
            "limit"   => self::DEFAULT_LIMIT,
            "page"    => $page
        ));
        
        return $paginator->getPaginate();
    }
    
    /**
     * 
     * @param int $value
     * @return int
     */
    protected function validateBoolean($value) {
        return (empty($value) ? 0 : 1);
    }
    
    /**
     * Validate if is a number
     * @param int $value
     * @return int
     */
    protected function validateNumber($value) {
        return (empty($value) || $value == 0 ? 0 : $value);
    }
}

