<?php
    require_once('db.php');

    if (isset($_GET['controller']) && isset($_GET['action'])){
      $controller = $_GET['controller'];
      $action     = $_GET['action'];
    } else {
      $controller = 'pages';
      $action     = 'error';
    }

    require_once('views/layout.php');
?>