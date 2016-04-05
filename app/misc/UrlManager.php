<?php

namespace Sayvot\Misc;

class UrlManager {
    
    protected $urlManager;
    protected $protocol;
    protected $host;
    protected $port;
    protected $app_base;
    protected $appbaseTrailing;

    public function __construct($config) {
        if (isset($config->urlmanager)) {
            $this->protocol = $config->urlmanager->protocol;
            $this->host = $config->urlmanager->host;
            $this->port = $config->urlmanager->port;
            if ($config->urlmanager->app_base != '') {
                $this->app_base = $config->urlmanager->app_base . '/';
            }
            else {
                $this->app_base = $config->urlmanager->app_base;
            }
            $this->api_v1 = $config->urlmanager->api_v1;
        }
        else {
            $this->protocol = "http";
            $this->host = "localhost";
            $this->port = 80;
            $this->appbase = "sayvot";
            $this->api_v1 = "api";
        }
        
        $this->appbaseTrailing = $this->app_base . (($this->app_base != '')?'/':'');
    }
	
    /**
     * Returns the protocol and host url
     * @param type $full
     * @return string
     */
    protected function getPrefix($full) {
        if ($full) {
            $prefix = $this->protocol . '://' .$this->host . '/';
        }
        else {
            $prefix = '';
        }
        return $prefix;
    }
	
    /**
     * Returns the url base ex: "emarketing" and url full ex: "http://localhost/emarketing"
     * @return type
     */
    public function getBaseUri($full = false) {
        return $this->getPrefix($full) . $this->app_base;
    }
	
	
    /**
     * Return uri for ember comunication (API_v1) ex: "emarketing/api"
     * @return URL string
     */
    public function getApi_v1Url($full = false) {
        return $this->getPrefix($full) . $this->appbaseTrailing . $this->api_v1;
    }
}
