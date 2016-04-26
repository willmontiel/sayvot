<?php

class SessionController extends ControllerBase {

  public function signupAction() {
    $account = new Account();
    $accountForm = new AccountForm($account);
    $this->view->accountForm = $accountForm;

    $user = new User();
    $userForm = new UserForm($user);
    $this->view->userForm = $userForm;
    
    $this->view->setVar("tab", 0);

    if ($this->request->isPost()) {
      try {
        $this->db->begin();

        $accountForm->bind($this->request->getPost(), $account);
        $userForm->bind($this->request->getPost(), $user);

        $idAccountplan = $accountForm->getValue('idAccountplan');
        $idAccounttype = $accountForm->getValue('idAccounttype');
        
        $city = $accountForm->getValue('city');
        
        $pass1 = $userForm->getValue('pass1');
        $pass2 = $userForm->getValue('pass2');
        
        $email = $this->request->getPost('email');

        $this->validateEqualsPassword($pass1, $pass2);
        
        $this->validateFields(array($idAccounttype, $idAccountplan, $city), array("Debes seleccionar un tipo de cuenta", "Debes seleccionar un plan de pago, recuerda que tenemos algunos gratuitos", "Debes seleccionar una ciudad"));

        if ($this->saveAccount($account, $accountForm, $userForm)) {
          if ($this->saveUser($user, $account)) {
            $file = $_FILES['avatar'];
            $ext = explode("/", $file['type']);
            $file['newName'] = "{$user->idUser}.{$ext[1]}";
            $dir = $this->uploader->user_avatar_dir . "/" . $user->idUser . "/images/avatar/";
            
            $uploader = new \Sayvot\Misc\Uploader();
            $uploader->setExtensionsAllowed(array("png", "jpg", "jpeg"));
            $uploader->setFile($file);
            $uploader->setMaxSizeSupported($this->uploader->images_max_size);
            $uploader->setDir($dir);
            $uploader->validate();
            $uploader->upload();
            
            if ($this->saveCredential($user, $email, $pass1)) {
              $this->db->commit();
              $pe = new \Sayvot\Misc\ParametersEncoder();
              $link = $pe->encodeLink("account/verify", array($account->idAccount, $user->idUser));
              $this->flashSession->warning($link);
              return $this->response->redirect("session/login");
            }
          }
        }
      } catch (InvalidArgumentException $ex) {
        $this->flashSession->error($ex->getMessage());
        $this->db->rollback();
      } catch (Exception $ex) {
        $this->db->rollback();
        $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
        $this->logger->log("Exception while creating account: " . $ex->getMessage());
        $this->logger->log($ex->getTraceAsString());
      }
    }
  }

  private function validateFields($fields, $messages) {
    foreach ($fields as $key => $field) {
      $field = trim($field);
      if (empty($field) || $field == "value") {
        throw new InvalidArgumentException($messages[$key]);
      }
    }
  }


  private function saveAccount(Account $account, $accountForm, $userForm) {
    $state = State::findFirstByIdState($accountForm->getValue('state'));
    $city = $userForm->getValue('city');

    $accounttype = $accountForm->getValue('idAccounttype');

    if ($accounttype == 3) {
      $account->name = $accountForm->getValue('accountName');
      $account->email = $accountForm->getValue('accountEmail');
      $account->phone = $accountForm->getValue('accountPhone');
      $account->address = $accountForm->getValue('accountAddress');
    } else {
      $account->name = $userForm->getValue('email');
      $account->email = $userForm->getValue('email');
      $account->phone = $userForm->getValue('phone');
      $account->address = $userForm->getValue('address');
    }
    
    $account->status = 1;
    $account->confirm = 0;
    $account->state = $state->name;
    $account->city = $city;
    return $this->saveModel($account, null);
  }

  private function saveUser(User $user, Account $account) {
    $user->idAccount = $account->idAccount;
    $user->status = 1;
    return $this->saveModel($user, null);
  }

  private function saveCredential(User $user, $email, $password) {
    $credential = new Credential();
    $credential->idUser = $user->idUser;
    $credential->firstTime = 1;
    $credential->email = $email;
    $credential->password = $this->hash->hash($password);
    return $this->saveModel($credential, "Se ha guardado el perfil exitosamente");
  }

  private function validateEqualsPassword($pass1, $pass2) {
    if ($pass1 != $pass2) {
      throw new InvalidArgumentException("Las contraseñas no coinciden, por favor valida la información");
    }
  }

  public function logoutAction() {
    $this->session->remove("user-name");
    $this->session->destroy();
    $this->response->redirect('session/login');
  }

  public function loginAction() {
    $loginForm = new LoginForm();
    $this->view->loginForm = $loginForm;

    if ($this->request->isPost()) {
      $login = $this->request->getPost("email");
      $password = $this->request->getPost("password");

      $credential = Credential::findFirst(array(
                  "email = ?0",
                  "bind" => array($login)
      ));

      if ($credential && $this->hash->checkHash($password, $credential->password)) {
        if ($credential->firstTime == 1) {
          
        }

        $user = User::findFirstByIdUser($credential->idUser);
        $account = Account::findFirstByIdAccount($user->idAccount);

        if ($account && $account->confirm == 0) {
          $this->flashSession->error("Esta cuenta no ha sido confirmada, por favor revisa tu correo y sigue los pasos");
        } else if ($account && $account->status == 1) {
          $this->session->set('userid', $user->idUser);
          $this->session->set('authenticated', true);
          $this->user = $user;
          return $this->response->redirect("");
        } else {
          $this->flashSession->error("La cuenta ha sido bloqueada, por favor contacte al administrador");
        }
      } else {
        $this->flashSession->error("Usuario o contraseña incorrecta");
      }
    }
  }

  public function recoverpasswordAction() {
    if ($this->request->isPost()) {
      $email = $this->request->getPost("email");
      $credential = Credential::findFirst(array(
                  'conditions' => 'email = ?1',
                  'bind' => array(1 => $email)
      ));

      if ($credential) {
        $user = User::findFirstByIdUser($credential->idUser);

        $cod = uniqid();
        $urlManager = $urlManager = Phalcon\DI::getDefault()->get('urlManager');
        $url = $urlManager->getBaseUri(true);
        $url .= 'session/reset/' . $cod;

        $tmprecoverpassword = new Tmprecoverpassword();
        $tmprecoverpassword->idTmprecoverpassword = $cod;
        $tmprecoverpassword->idUser = $user->idUser;
        $tmprecoverpassword->url = $url;
        $tmprecoverpassword->date = time();

        if (!$tmprecoverpassword->save()) {
          foreach ($tmprecoverpassword->getMessages() as $msg) {
            $this->logger->log('Msg: ' . $msg);
          }

          $this->flashSession->error('Ha ocurrido un error contacte al administrador');
        } else {
          $link = '<a href="' . $url . '" style="text-decoration: underline;">Click aqui</a>';
          try {
            $this->logger->log($link);
            $NotificationMail = new \Sayvot\Misc\NotificationMail();
            $NotificationMail->createRecoverpasswordMail($credential->email, $link);
            $NotificationMail->sendMail();
          } catch (Exception $e) {
            $this->logger->log('Exception: ' . $e->getMessage());

            $this->flashSession->error('Ha ocurrido un error contacte al administrador');
          }
        }
      }

      $this->flashSession->success('Se ha enviado un correo electronico con instrucciones para recuperar la contraseña');

      return $this->response->redirect('session/login');
    }
  }

  public function resetpasswordAction($unique) {
    $url = Tmprecoverpassword::findFirst(array(
                'conditions' => 'idTmprecoverpassword = ?1',
                'bind' => array(1 => $unique)
    ));

    $time = strtotime("-30 minutes");

    if ($url && ($url->date <= $time || $url->date >= $time)) {
      $this->session->set('idUser', $url->idUser);
      $this->view->setVar('uniq', $unique);
    } else {
      return $this->response->redirect('error/link');
    }
  }

  public function setnewpasswordAction() {
    if ($this->request->isPost()) {
      $uniq = $this->request->getPost("uniq");

      $url = Tmprecoverpassword::findFirst(array(
                  'conditions' => 'idTmprecoverpassword = ?1',
                  'bind' => array(1 => $uniq)
      ));

      $time = strtotime("-30 minutes");

      if (!$url && $url->date <= $time) {
        $this->flashSession->success('El tiempo para recuperar su contraseña, ha caducado, por favor haga el proceso desde cero');
        return $this->response->redirect('session/login');
      }

      $password1 = $this->request->getPost("password1");
      $password2 = $this->request->getPost("password2");

      if (empty($password1) || empty($password2)) {
        $this->flashSession->error("No has enviado las contraseñas");
        return $this->response->redirect('session/resetpassword/' . $uniq);
      }

      if (strlen($password1) < 8 || strlen($password2) > 40) {
        $this->flashSession->error("La contraseña es muy corta o muy larga, esta debe tener mínimo 8 y máximo 40 caracteres, por favor verifique la información");
        return $this->response->redirect('session/resetpassword/' . $uniq);
      }

      if ($password1 !== $password2) {
        $this->flashSession->error("Las contraseñas no coinciden, por favor verifique la información");
        return $this->response->redirect('session/resetpassword/' . $uniq);
      }

      $idUser = $this->session->get('idUser');

      $credential = Credential::findFirst(array(
                  'conditions' => 'idUser = ?1',
                  'bind' => array(1 => $idUser)
      ));

      if (!$credential) {
        $this->flashSession->error("No existe el usuario, por favor valida la información");
        return $this->response->redirect('session/login');
      }

      $credential->password = $this->hash->hash($password1);

      if (!$credential->save()) {
        $this->flashSession->notice('Ha ocurrido un error, contacte con el administrador');
        foreach ($user->getMessages() as $msg) {
          $this->logger->log('Error while recovering user password' . $msg);
        }
      }

      $this->flashSession->notice('Se ha actualizado el usuario exitosamente');
      return $this->response->redirect('session/login');
    }
  }

  public function loginlikethisuserAction($idUser) {
    $user = User::findFirst(array(
                'conditions' => 'idUser = ?1',
                'bind' => array(1 => $idUser)
    ));

    if (!$user) {
      $this->flashSession->error("No se ha podido ingresar como el usuario, porque este no existe");
      return $this->response->redirect('account/index');
    }

    $this->session->set('userid', $user->idUser);
    $this->session->set('authenticated', true);

    $this->user = $user;
    $this->user->userrole = 'ROLE_SUDO';

    $uefective = $this->session->get('userefective');
    $this->traceSuccess("Login by sudo: {$uefective->username} / {$uefective->idUser}, in account {$this->user->account->idAccount} with user {$this->user->username} / {$this->user->idUser}");
    return $this->response->redirect("");
  }

  public function logoutfromthisaccountAction() {
    $uefective = $this->session->get('userefective');
    $olduser = $this->user;
    $oldAccount = $this->user->account;

    if (isset($uefective)) {
      $this->session->set('userid', $uefective->idUser);
      $this->session->set('authenticated', true);

      $this->user = $uefective;

      $this->session->remove('userefective');
      $this->traceSuccess("Logout by sudo: {$uefective->username} / {$uefective->idUser}, in account {$oldAccount->idAccount} with user {$olduser->username} / {$olduser->idUser}");
      return $this->response->redirect("");
    } else {
      return $this->response->redirect("error/unauthorized");
    }
  }

}
