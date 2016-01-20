<?php

use Phalcon\Events\Event,
    Phalcon\Mvc\User\Plugin,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Acl;
/**
 * Security
 *
 * Este es la clase que proporciona los permisos a los usuarios. Esta clase decide si un usuario pueder hacer determinada
 * tarea basandose en el tipo de ROLE que posea
 */
class Security extends Plugin {
    public function __construct($dependencyInjector) {
        $this->_dependencyInjector = $dependencyInjector;
    }    
    
    public function getAcl() {
        
    }
    
    protected function getControllerMap() {
        
    }
    
    public function beforeDispatch(Event $event, Dispatcher $dispatcher) {
        
    }
}