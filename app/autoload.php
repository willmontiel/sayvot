<?php
    $loader = new \Phalcon\Loader();

    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/plugins/',
        '../app/models/',
        '../app/forms/',
        '../app/library/',
    ));

    $loader->registerNamespaces(array(
        'SayVot\\Misc' => '../app/misc/',
        'SayVot\\Logic' => '../app/logic/'
    ), true);

    // register autoloader
    $loader->register();