<?php

class Notificationmail extends BaseModel {
    public $idNotificationmail;
    public $name;
    public $description;
    public $type;
    public $createdon;
    public $updatedon;
    public $fromEmail;
    public $fromName;
    public $replyto;
    public $subject;
    public $content;
    public $plaintext;
}