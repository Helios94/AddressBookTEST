<DOCTYPE html>
    <html>
    <head>
        <?php include_once 'head_includes.php'?>
    </head>
    <body>
        <br/>
        <?php
            if (session_status() === PHP_SESSION_NONE) session_start();
            if(isset($_SESSION["id_user"]) && !empty($_SESSION["id_user"]) && $_SESSION["id_user"] != null) {
                include_once 'nav.php';
            }
        ?>
        <content>