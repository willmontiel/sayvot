<?php
    $loader = new \Phalcon\Loader();

    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/plugins/',
        '../app/models/',
        '../app/forms/',
        '../app/library/',
        '../app/validators/',
    ));
    
    $loader->registerNamespaces(array(
        'Sayvot\\Misc' => '../app/misc/',
        'Sayvot\\Logic' => '../app/logic/'
    ), true);

    // register autoloader
    $loader->register();