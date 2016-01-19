<?php

require_once '../app/autoload.php';

try {
    $app = new \Sayvot\Logic\AppObjects();
    $app->setConfigPath("../app/config/configuration.ini");
	
    $app->configure();
	
    $di = $app->getDi();
	
    //Handle the request
    $application = new \Phalcon\Mvc\Application($di);
    echo $application->handle()->getContent();
} 
catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}
