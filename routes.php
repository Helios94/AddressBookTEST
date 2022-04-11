<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
      case 'users':
        require_once('models/user.php');
        $controller = new usersController();
        break;
      case 'addresses':
        require_once('models/address.php');
        $controller = new addressesController();
      break;
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('pages' => ['home', 'error'],
                       'users' => ['index', 'show', 'newUser', 'login', 'logout', 'signup', 'doLogin'],
                       'addresses' => ['index', 'show', 'newAddress', 'delete','edit', 'update']);

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if(isset($_SESSION["id_user"]) && !empty($_SESSION["id_user"]) && $_SESSION["id_user"] != null) {
            if (($controller == 'pages' && $action == 'home') || ($controller == 'users' && $action != 'logout')){
                $controller = 'addresses';
                $action = 'index';
            }
        }else{
            if ($controller == 'addresses'){
                $controller = 'pages';
                $action = 'home';
            }
        }
        call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>