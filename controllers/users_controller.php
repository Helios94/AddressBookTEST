<?php
  class usersController {

    protected function redirectToLogin(){
      header('Location: ?controller=pages&action=home');
    }

    protected function redirectToSignup(){
      header('Location: ?controller=users&action=newUser');
    }

    public function newUser(){
      require_once('views/users/create.php');
    }

    public function login(){
      require_once('views/users/login.php');
    }

    public function signup(){
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'fullname' => $_POST['fullname'],
            'email' => trim($_POST['email']),
            'password' => $_POST['password'],
            'confirm-password' => $_POST['confirm-password']
        ];
        if($data['password'] != $data['confirm-password']){
          $_SESSION["signup_login"] = 'Check the password';
          $this->redirectToSignup();
          exit;
        }
        $user = user::createUser($data['fullname'], $data['email'], $data['password']);
        // var_dump($user);
        // exit;
        if($user == 'error'){
          $_SESSION["signup_login"] = 'An error has occured during creation';
          $this->redirectToSignup();
          exit;
        }else{
          $_SESSION["id_user"] = $user;
          header('Location: ?controller=addresses&action=index');
          exit;
        }
      }
    }

    public function doLogin(){
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'email' => trim($_POST['email']),
            'password' => $_POST['password']
        ];
        $user = user::findByEmailAndPassword($data['email'], $data['password']);
          if (session_status() === PHP_SESSION_NONE) session_start();
        if(empty($user) || $user == null || $user == false){
          $_SESSION["error_login"] = true;
          $this->redirectToLogin();
        }else{
            $userid = $user->id;
            $_SESSION["id_user"] = $userid;
            header('Location: ?controller=addresses&action=index');
        }
      }
    }

    public function logout(){
        $_SESSION = array();
        session_destroy();
        $this->redirectToLogin();
    }
  }
