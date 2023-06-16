<?php
function check_login()
{
    if (empty($_SESSION['email'])) {
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = "./simulador_login.php";
        header("Location: http://$host$uri/$extra");
        exit();
    }
}

?>