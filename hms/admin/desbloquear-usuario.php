<?php
session_start();
error_reporting(0);
include("include/config.php");

if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];
    
    // Verificar si el usuario existe
    $query = mysqli_query($con, "SELECT * FROM users WHERE id='$idUsuario'");
    $num = mysqli_num_rows($query);
    
    if ($num > 0) {
        // Eliminar los intentos fallidos del usuario
        eliminarIntentosPorUsuario($idUsuario);
        
        // Redirigir a la página de usuarios bloqueados con un mensaje de éxito
        $_SESSION['successmsg'] = "Usuario desbloqueado exitosamente.";
        header("Location: usuarios_bloqueados.php");
        exit();
    } else {
        // Redirigir a la página de usuarios bloqueados con un mensaje de error
        $_SESSION['errmsg'] = "No se encontró ningún usuario con el ID proporcionado.";
        header("Location: usuarios_bloqueados.php");
        exit();
    }
} else {
    // Redirigir a la página de usuarios bloqueados si no se proporciona el ID
    header("Location: usuarios_bloqueados.php");
    exit();
}

# Función para eliminar los intentos fallidos de un usuario por su ID
function eliminarIntentosPorUsuario($idUsuario)
{
    global $con;
    mysqli_query($con, "DELETE FROM intentos_usuarios WHERE id_usuario='$idUsuario'");
}
?>
