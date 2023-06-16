<?php
session_start();

// Elimina todas las variables de sesión
$_SESSION = array();

// Si se desea destruir el cookie de sesión, descomenta la siguiente línea
// (Esto eliminará el cookie de sesión, pero puede causar problemas si hay otros scripts que dependen del cookie de sesión)
// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
// }

// Destruye la sesión
session_destroy();

// Redirige al usuario a la página de inicio de sesión u otra página deseada
header("Location: simulador_login.php");
exit();
?>
