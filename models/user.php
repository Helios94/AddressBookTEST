<?php
  class user {
    // we define 3 attributes
    // they are public so that we can access them using $user->author directly
    public $id_user;
    public $name;
    public $email;
    public $password;

    public function __construct($id_user, $name, $email) {
      $this->id    = $id_user;
      $this->name  = $name;
      $this->email = $email;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM users');

      // we create a list of user objects from the database results
      foreach($req->fetchAll() as $user) {
        $list[] = new user($user['id_user'], $user['name'], $user['email']);
      }

      return $list;
    }

    public static function find($id_user) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id_user);
      $req = $db->prepare('SELECT * FROM users WHERE id_user = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $user = $req->fetch();

      return new user($user['id_user'], $user['name'], $user['email']);
    }

    public static function findByEmailAndPassword($email, $password){
      $db = Db::getInstance();
      $req = $db->prepare("SELECT * FROM users WHERE email = '{$email}'");
      $req->execute();
      $user = $req->fetch();
      if (password_verify($password, $user['password'])){
          return (Object) $user;
      }else{
          return false;
      }
    }

    public static function createUser($fullname, $email, $password){
      $db = Db::getInstance();
        $options = [
            'cost' => 12,
        ];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
        echo $hashedPassword;
      try{
        $req = $db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $req->execute(
          array(
              'name' => $fullname,
              'email' => $email,
              'password' => $hashedPassword
          )
        );
        $req->fetch();
        $newUserID = $db->lastInsertId();
        return $newUserID;
      }
      catch(\PDOException $e){
        // return $e->getMessage();
        return 'error';
      }
    }
  }
