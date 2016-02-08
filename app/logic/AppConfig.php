<?php

namespace Sayvot\Logic;

class AppConfig {
    /**
     *
     * @var \Phalcon\DI
     */
    protected $config;
    protected $di;
    protected $urlManager;

    /**
     * Archivo de configuración del sistema necesario para iniciar la plataforma 
     * @param String ruta del archivo de configuración
     */
    public function setConfigPath($configPath) {
        $this->config = new \Phalcon\Config\Adapter\Ini($configPath);
    }
	
        
    public function configure() {
        $this->createDi();
        $this->setThemeData();

        $this->setAppPath();
        $this->setFullPath();
        $this->setUrlManagerObject();
        $this->setUri();
        $this->setRouter();

        $this->setAcl();
        $this->setMemcache();
        $this->setDispatcher();
        $this->setSecurityHash();
        $this->setSessionManager();

        $this->setFlashSessionMessages();
        $this->setFlashMessages();

        $this->setModelsMetadata();
        $this->setUploadConfig();

        $this->setDb();
        $this->setModelsManager();

        $this->setTmpFolder();
        
        $this->setLogger();

        $this->setSmartMenu();
        $this->setVoltCompiler();
        $this->setView();
    }

    /**
     * Creación del inyector de dependencias
     */
    private function createDi() {
        $this->di = new \Phalcon\DI\FactoryDefault();
    }
	
    /**
     * Ruta principal de la aplicacion
     * @return DI object
     */
    private function setAppPath() {
        // Ruta de APP
        $apppath = realpath('../');
        $this->di->set('appPath', function () use ($apppath) {
            $obj = new \stdClass;
            $obj->path = $apppath;

            return $obj;
        });
    }
	
    /**
     * El objeto encargado de armar las url puntuales basandose en el archivo de configuración
     */
    private function setUrlManagerObject() {
        $this->urlManager = new \Sayvot\Misc\UrlManager($this->config);
        $this->di->set('urlManager', $this->urlManager);    
    }
	
    /**
     * Configuración de la base URI, para generar automaticacmente todas las direcciones posibles dentro de la carpeta 
     * principal de la aplicación
     * @return DI object
     */
    private function setUri() {
        $urlManagerObj = $this->urlManager;
        $this->di->set('url', function() use ($urlManagerObj) {
            $url = new \Phalcon\Mvc\Url();
            $uri = $urlManagerObj->getBaseUri();

            // Adicionar / al inicio y al final
            if (substr($uri, 0, 1) != '/') {
                    $uri = '/' . $uri;
            }
            if (substr($uri, -1) != '/') {
                    $uri .= '/';
            }

            $url->setBaseUri($uri);
            return $url;
        });
    }
	
    /**
     * Encargado de enrutar las peticiones de acuerdo a su url
     * @return DI object
     */
    public function setRouter() {
        $this->di->set('router', function () {
            $router = new \Phalcon\Mvc\Router\Annotations();
            $router->addResource('Api', '/api');
            return $router;
        });
    }
	
    /**
     * Encargado de escuchar cada peticion(controlador/acción) que hace el usuario a la plataforma
     * @return DI object
     */
    private function setDispatcher() {
        $di = $this->di;
        $di->set('dispatcher', function() use ($di) {
            $eventsManager = $di->getShared('eventsManager');

            $security = new \Security($di);
            /**
             * We listen for events in the dispatcher using the Security plugin
             */
            $eventsManager->attach('dispatch', $security);

            $dispatcher = new \Phalcon\Mvc\Dispatcher();
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });
    }
	
    /**
     * Comunicación con Memcache
     * @return DI object
     */
    private function setMemcache()  {
        $conf = $this->config;
        $this->di->set('cache', function () use ($conf){
            $frontCache = new \Phalcon\Cache\Frontend\Data(array(
                "lifetime" => 172800
            ));

            if (class_exists('Memcache')) {
                $cache = new \Phalcon\Cache\Backend\Memcache($frontCache, array(
                    "host" => "localhost",
                    "port" => "11211"
                ));
            }
            else {
                $cache = new \Phalcon\Cache\Backend\File($frontCache, array(
                    "cacheDir" => $conf->general->tmpdir
                ));
            }
            return $cache;
        });
    }
	
    /**
     * Se encargar de injectar la clase que administra el menu principal de la aplicación
     * @return DI object
     */
    private function setSmartMenu() {
        $this->di->set('smartMenu', function(){
            //return new \VisualElements();
        });
    }
	
    /**
     * Lista de control de usuario para permisos sobre recursos
     * @return DI object
     */
    private function setAcl() {
        $this->di->set('acl', function(){
            $acl = new \Phalcon\Acl\Adapter\Memory();
            $acl->setDefaultAction(\Phalcon\Acl::DENY);

            return $acl;
        });
    }
	
    /**
     * Hash para validacion y creacion de contraseñas de los usuarios
     * @return DI object
     */
    private function setSecurityHash() {
        $this->di->set('hash', function(){
            $hash = new \Phalcon\Security();
            //Set the password hashing factor to 12 rounds
            $hash->setWorkFactor(12);
            return $hash;
        }, true);
    }
	
    /**
     * Models metadata crea metadatos en cache de los modelos en la aplicación
     * para evitar estar consultandolos
     * @return DI object
     */
    private function setModelsMetadata() {
        $this->di->set('modelsMetadata', function() {
            $metaData = new \Phalcon\Mvc\Model\MetaData\Files(array(
//			"lifetime" => 86400,
                "metaDataDir"   => "../app/cache/metadata/"
            ));
            return $metaData;
        });
    }
	
    /**
     * Database Object, conexion primaria a la base de datos
     * @return DI object
     */
    private function setDb() {
        $config = $this->config;
        $di = $this->di;
        $di->setShared('db', function() use ($config) {
            // Events Manager para la base de datos
            $eventsManager = new \Phalcon\Events\Manager();

            $connection = new \Phalcon\Db\Adapter\Pdo\Mysql($config->database->toArray());

            $connection->setEventsManager($eventsManager);

            return $connection;
        });
    }
	
    /**
     * Para creación de consultas PHQL
     * @return DI object
     */
    private function setModelsManager() {
        $this->di->set('modelsManager', function(){
            return new \Phalcon\Mvc\Model\Manager();
        });
    }

    /**
     * Directorio de para archivos temporales
     */
    private function setTmpFolder() {
        $tmp = new \stdClass;
        $tmp->dir = $this->config->uri->tmp;
        $this->di->set('tmp', $tmp);
    }
	

    /*
     * Configuración de archivos que el usuario carga al servidor, como por ejemplo el peso.
     */
    private function setUploadConfig() {
            $uploadConfig = new \stdClass();
            $uploadConfig->images = $this->config->upload->images;
            $uploadConfig->attachment = $this->config->upload->attachment;
            $this->di->set('uploadConfig', $uploadConfig);
    }
	
    /**
     * Gestor de sesiones
     * @return DI object
     */
    private function setSessionManager() {
        $this->di->setShared('session', function() {
            $session = new \Phalcon\Session\Adapter\Files(
                array(
                    'uniqueId' => 'sayvot' 
                ));
            $session->start();
            return $session;
        });
    }
	
    /**
     * Flash Object, para mantener mensajes flash entre una página y otra
     * @return DI object
     */
    private function setFlashSessionMessages() {
        $this->di->set('flashSession', function(){
            $flash = new \Phalcon\Flash\Session(array(
                'error' => 'alert alert-danger',
                'success' => 'alert alert-success',
                'notice' => 'alert alert-info',
                'warning' => 'alert alert-warning'
            ));
            return $flash;
        });
    }
	
    /**
     * FlashMessage Object, para mostrar mensajes informativos y administrativos a los usuarios
     * @return DI object
     */
    public function setFlashMessages() {
        $this->di->set('flashMessage', function(){
//            $flashMessage = new \FlashMessages();
//            return $flashMessage;
        });
    }


    public function setThemeData() {
        $config = $this->config;

        $this->di->set('theme', function() use ($config) {
            $theme = new \stdClass;

            if (isset($config->theme->name)) {
                $theme->name = $config->theme->name;
                $theme->logo = $config->theme->logo;
                $theme->title = $config->theme->title;
                $theme->subtitle = $config->theme->subtitle;
                $theme->footer = $config->theme->footer;
            }
            else {
                $theme->name = 'base';
                $theme->logo = '';
                $theme->title = 'SayVot';
                $theme->subtitle = '';
                $theme->footer = '';
            }
            return $theme;
        });
    }
	
    /**
     * Log Object, utilizado para logging en general a archivo
     * @return DI object
     */
    private function setLogger() {
        $this->di->set('logger', function () {
            return new \Phalcon\Logger\Adapter\File("../app/logs/debug.log");
        });
    }
	
    /**
     * Compilador de archivos volt
     * @param type $di
     * @return DI object
     */
    private function setVoltCompiler() {
        $di = $this->di;
        $di->setShared('volt', function($view, $di) {
            $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
                        
            $volt->setOptions(array(
                "compileAlways" => true,
                "compiledPath" => "../app/compiled-volt-files/",
                'stat' => true
            ));

            return $volt;
        });
    }
	
    /**
     * Encargado de configurar volt 
     * @return DI object
     */
    private function setView() {
        $this->di->set('view', function() {
            $view = new \Phalcon\Mvc\View();
            $view->setViewsDir('../app/views/');
            $view->registerEngines(array(
                ".volt" => 'volt'
            ));
            return $view;
        });
    }
	
    private function setFullPath() {
        $path = new \stdClass();
        $path->path = $this->config->uri->path;
        $this->di->set('path', $path);
    }

    public function getDi() {
        return $this->di;
    }

    public function getConfig() {
        return $this->config;
    }
}