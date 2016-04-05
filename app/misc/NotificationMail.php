<?php

namespace Sayvot\Misc;

class NotificationMail {
    protected $notification;
    protected $email;

    public function __construct() {
        
    }

    public function createRecoverpasswordMail($email, $link) {
        $this->email = $email;
        
        $this->notification = \Notificationmail::findFirst(array(
            "conditions" => "type = 0?",
            "bind" => array("recoverpassword")
        ));
        
        $this->notification->content = str_replace("tmp-url", $link, $this->notification->content);
        $this->notification->plaintext = str_replace("tmp-url", $link, $this->notification->plaintext);
    }
    
    public function sendMail() {
        
    }
}

