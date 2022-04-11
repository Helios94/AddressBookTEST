<?php
  class address {
    // we define 3 attributes
    // they are public so that we can access them using $address->author directly
    public $id_address;
    public $first_name;
    public $last_name;
    public $company;
    public $state;

    public function __construct() {
    
    }

    public static function updateAddress($data, $user_id){
          $db = Db::getInstance();
          try{
              $req = $db->prepare('UPDATE addresses SET first_name = :firstName, last_name = :lastName, avatar = :avatar, company = :company, mobile_number = :mobileNumber, work_number = :workNumber, home_number = :personalNumber, work_email = :workEmail, personal_email = :personalEmail, street = :street, zip = :zip, city = :city, state = :state, country = :country WHERE id_address = :id_address AND user_id = :user_id');
              $req->execute(
                  array(
                      'id_address' => $data['id_address'],
                      'firstName' => $data['firstName'],
                      'lastName' => $data['lastName'],
                      'avatar' => $data['avatar'],
                      'company' => $data['company'],
                      'mobileNumber' => $data['mobileNumber'],
                      'workNumber' => $data['workNumber'],
                      'personalNumber' => $data['personalNumber'],
                      'workEmail' => $data['workEmail'],
                      'personalEmail' => $data['personalEmail'],
                      'street' => $data['street'],
                      'city' => $data['city'],
                      'state' => $data['state'],
                      'zip' => $data['zip'],
                      'country' => $data['country'],
                      'user_id' => $user_id
                  )
              );
              $req->fetch();
              return true;
          }
          catch(\PDOException $e){
              // return $e->getMessage();
              return 'error';
          }
      }

    public static function createAddress($data, $user_id){
      $db = Db::getInstance();
      try{
          $req = $db->prepare('INSERT INTO addresses (first_name, last_name, avatar, company, mobile_number, work_number, home_number, work_email, personal_email, street, zip, city, state, country, user_id) VALUES (:firstName, :lastName, :avatar, :company, :mobileNumber, :workNumber, :personalNumber, :workEmail, :personalEmail, :street, :zip, :city, :state,  :country, :user_id)');
          $req->execute(
              array(
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'avatar' => $data['avatar'],
                'company' => $data['company'],
                'mobileNumber' => $data['mobileNumber'],
                'workNumber' => $data['workNumber'],
                'personalNumber' => $data['personalNumber'],
                'workEmail' => $data['workEmail'],
                'personalEmail' => $data['personalEmail'],
                'street' => $data['street'],
                'city' => $data['city'],
                'state' => $data['state'],
                'zip' => $data['zip'],
                'country' => $data['country'],
                'user_id' => $user_id
              )
          );
          $req->fetch();
          $newAddressID = $db->lastInsertId();
          return $newAddressID;
      }
      catch(\PDOException $e){
          // return $e->getMessage();
          return 'error';
      }
    }


    public static function all($user_id) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query("SELECT * FROM addresses WHERE user_id = {$user_id} AND deleted_at IS NULL");
      foreach($req->fetchAll() as $address) {
        $list[] = (Object) $address;
      }

      return $list;
    }

    public static function find($id_address, $user_id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id_address);
      $req = $db->prepare('SELECT * FROM addresses WHERE id_address = :id AND user_id = :user_id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array(
                    'id' => $id,
                    'user_id' => $user_id
                )
            );
      $address = $req->fetch();

      return (Object) $address;
    }

    public static function delete($id_address, $user_id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id_address);
      $req = $db->prepare('UPDATE addresses SET deleted_at = now() WHERE id_address = :id AND user_id = :user_id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array(
              'id' => $id,
              'user_id' => $user_id
          )
      );
      $address = $req->fetch();
      return (Object) $address;
    }
  }
?>