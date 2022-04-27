<?php
  class AddressesController {

    public function uploadAvatar($avatarFile){
        $target_dir = "assets/img/contacts/";
        $target_file = $target_dir .uniqid().'.'.pathinfo($avatarFile["name"], PATHINFO_EXTENSION);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if img extension is allowed
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }
        // if extension check error : exit
        if ($uploadOk == 0){
            return $uploadOk;
        }

        if (move_uploaded_file($avatarFile["tmp_name"], $target_file)) {
            $uploadOk = $target_file;
//            echo "The file ". htmlspecialchars( basename( $avatarFile["name"])). " has been uploaded.";
        } else {
            $uploadOk = 0;
            //echo "Sorry, there was an error uploading your file.";
        }
        return $uploadOk;
    }

    public function index() {
        $addresses = address::all($_SESSION["id_user"]);
        require_once('views/addresses/index.php');
    }

    public function show() {
        $address = address::find($_GET['id'], $_SESSION["id_user"]);
        require_once('views/addresses/show.php');
    }

    public function edit() {
      $address = address::find($_GET['id'], $_SESSION["id_user"]);
      require_once('views/addresses/edit.php');
    }

    public function update(){
          if(!isset($_SESSION["id_user"]) || empty($_SESSION["id_user"]) || $_SESSION["id_user"] == null) {
              return http_response_code(401);
          }
          if($_SERVER['REQUEST_METHOD'] == 'POST') {
              //sanitize POST data
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $avatarPath = null;
              // upload avatar image
              if((isset($_FILES["avatar"]) && $_FILES["avatar"]['error'] != UPLOAD_ERR_NO_FILE)){
                  $avatarPath = $this->uploadAvatar($_FILES["avatar"]);
              }else{
                  $avatarPath = $_POST['old_avatar'];
              }

              $data = [
                  'id_address' => $_POST['id_address'],
                  'firstName' => htmlspecialchars($_POST['first-name']),
                  'lastName' => htmlspecialchars($_POST['last-name']),
                  'avatar' => $avatarPath,
                  'company' => htmlspecialchars($_POST['company']),
                  'workEmail' => $_POST['work-email'],
                  'personalEmail' => $_POST['personal-email'],
                  'mobileNumber' => $_POST['mobile-number'],
                  'workNumber' => $_POST['work-number'],
                  'personalNumber' => $_POST['personal-number'],
                  'street' => htmlspecialchars($_POST['street']),
                  'city' => htmlspecialchars($_POST['city']),
                  'state' => htmlspecialchars($_POST['state']),
                  'zip' => htmlspecialchars($_POST['zip']),
                  'country' => htmlspecialchars($_POST['country']),
              ];
              $address = address::updateAddress($data, $_SESSION["id_user"]);
              var_dump($address);
              exit();
              if($address === 'error'){
                  $_SESSION["update_address_error"] = 'An error has occured during address update';
              }
              header('Location: ?controller=addresses&action=index');
          }
  }

    public function newAddress(){
        if(!isset($_SESSION["id_user"]) || empty($_SESSION["id_user"]) || $_SESSION["id_user"] == null) {
            return http_response_code(401);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $avatarPath = null;
            // upload avatar image
            if((isset($_FILES["avatar"]) && $_FILES["avatar"]['error'] != UPLOAD_ERR_NO_FILE)){
                $avatarPath = $this->uploadAvatar($_FILES["avatar"]);
            }

            $data = [
                'firstName' => htmlspecialchars($_POST['first-name']),
                'lastName' => htmlspecialchars($_POST['last-name']),
                'avatar' => $avatarPath,
                'company' => htmlspecialchars($_POST['company']),
                'workEmail' => $_POST['work-email'],
                'personalEmail' => $_POST['personal-email'],
                'mobileNumber' => $_POST['mobile-number'],
                'workNumber' => $_POST['work-number'],
                'personalNumber' => $_POST['personal-number'],
                'street' => htmlspecialchars($_POST['street']),
                'city' => htmlspecialchars($_POST['city']),
                'state' => htmlspecialchars($_POST['state']),
                'zip' => htmlspecialchars($_POST['zip']),
                'country' => htmlspecialchars($_POST['country']),
            ];
            $address = address::createAddress($data, $_SESSION["id_user"]);

            if($address === 'error'){
              $_SESSION["new_address_error"] = 'An error has occured during address creation';
            }
            header('Location: ?controller=addresses&action=index');
      }
    }

    public function delete() {
        $address = address::delete($_GET['id'], $_SESSION["id_user"]);
        header('Location: ?controller=addresses&action=index');
    }
  }
?>