<?php
session_start();
error_reporting(0);
include("include/config.php");

# El número de intentos máximos
define("MAXIMOS_INTENTOS", 2);

if (isset($_POST['submit'])) {
    $correo = $_POST['username'];
    $palabraSecreta = md5($_POST['password']);
    
    $valor = hacerLogin($correo, $palabraSecreta);
    
    if ($valor == 1) {
        // Inicio de sesión exitoso
        $extra = "dashboard.php";
        $_SESSION['login'] = $correo;
        $_SESSION['id'] = obtenerUsuarioId($correo);
        $host = $_SERVER['HTTP_HOST'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 1;
        
        // Almacenar registro de inicio de sesión exitoso en userlog
        $log = mysqli_query($con, "INSERT INTO userlog(uid, username, userip, status) VALUES ('" . $_SESSION['id'] . "', '" . $_SESSION['login'] . "', '$uip', '$status')");
        
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        exit();
    } else if ($valor == 2) {
        // Límite de intentos alcanzado
        $_SESSION['errmsg'] = "Límite de intentos alcanzado. Contacta al administrador para reiniciar.";
        $extra = "user-login.php";
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        exit();
    } else {
        // Usuario o contraseña incorrectos
        $_SESSION['login'] = $correo;
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 0;
        
        // Almacenar registro de intento fallido en userlog
        mysqli_query($con, "INSERT INTO userlog(username, userip, status) VALUES ('" . $_SESSION['login'] . "', '$uip', '$status')");
        
        $_SESSION['errmsg'] = "Nombre de usuario o contraseña inválidos";
        $extra = "user-login.php";
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        exit();
    }
}

# Función para obtener el ID de usuario basado en el correo electrónico
function obtenerUsuarioId($correo)
{
    global $con;
    $query = mysqli_query($con, "SELECT id FROM users WHERE email='$correo'");
    $row = mysqli_fetch_assoc($query);
    return $row['id'];
}

# Función para realizar el inicio de sesión y verificar el límite de intentos
function hacerLogin($correo, $palabraSecreta)
{
    global $con;
    
    # Verificar si el usuario ha alcanzado el límite de intentos
    $conteoIntentos = obtenerConteoIntentosFallidos($correo);
    if ($conteoIntentos >= MAXIMOS_INTENTOS) {
        return 2;
    }
    
    # Consultar la información del usuario y verificar las credenciales
    $ret = mysqli_query($con, "SELECT * FROM users WHERE email='$correo' AND password='$palabraSecreta'");
    $num = mysqli_fetch_array($ret);
    
    if ($num > 0) {
        eliminarIntentos($correo);
        return 1;
    } else {
        agregarIntentoFallido($correo);
        return 0;
    }
}

# Función para obtener el conteo de intentos fallidos de un usuario
function obtenerConteoIntentosFallidos($correo)
{
    global $con;
    $query = mysqli_query($con, "SELECT COUNT(*) AS conteo FROM intentos_usuarios WHERE id_usuario=(SELECT id FROM users WHERE email='$correo')");
    $row = mysqli_fetch_assoc($query);
    return $row['conteo'];
}

# Función para agregar un intento fallido a la tabla intentos_usuarios
function agregarIntentoFallido($correo)
{
    global $con;
    $idUsuario = obtenerUsuarioId($correo);
    mysqli_query($con, "INSERT INTO intentos_usuarios (id_usuario, intento) VALUES ('$idUsuario', NOW())");
}

# Función para eliminar los intentos fallidos de un usuario
function eliminarIntentos($correo)
{
    global $con;
    $idUsuario = obtenerUsuarioId($correo);
    mysqli_query($con, "DELETE FROM intentos_usuarios WHERE id_usuario='$idUsuario'");
}

# Función para obtener los usuarios con intentos fallidos
function obtenerUsuariosConIntentosFallidos()
{
    global $con;
    $query = "SELECT u.id, u.fullName, u.email, COUNT(i.id) AS intentos_fallidos
              FROM users u
              LEFT JOIN intentos_usuarios i ON u.id = i.id_usuario
              GROUP BY u.id, u.fullName, u.email";
    $result = mysqli_query($con, $query);
    
    $usuarios = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $usuario = new stdClass();
        $usuario->id = $row['id'];
        $usuario->fullName = $row['fullName'];
        $usuario->email = $row['email'];
        $usuario->intentos_fallidos = $row['intentos_fallidos'];
        $usuarios[] = $usuario;
    }
    
    return $usuarios;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Desbloquear Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        
        h2 {
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            
        }

        
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: lightblue;
            border-radius: 5px;
        }
        
        td:last-child {
            text-align: center;
        }
        
        .success-msg {
            color: green;
            margin-bottom: 10px;
        }
        
        .error-msg {
            color: red;
            margin-bottom: 10px;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }

        a{
            width: 80px;
            height: 20px;
            text-align:center ;
            border: 1px solid black;
        }
        a:hover{
            width: 80px;
            height: 20px;
            background-color:lig;
            color:black;
        }
    </style>
</head>
<body>


    <h2>Desbloquear Usuario</h2>
    
    <?php
    // Mostrar mensajes de éxito o error si existen
    if (isset($_SESSION['successmsg'])) {
        echo '<p class="success-msg">' . $_SESSION['successmsg'] . '</p>';
        unset($_SESSION['successmsg']);
    }
    if (isset($_SESSION['errmsg'])) {
        echo '<p class="error-msg">' . $_SESSION['errmsg'] . '</p>';
        unset($_SESSION['errmsg']);
    }
    ?>
    
    <table>
        <tr>
            <th>ID de Usuario</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Estado de Bloqueo</th>
            <th>Acción</th>
        </tr>
        
        <?php
        // Obtener los usuarios y su estado de bloqueo
        $usuarios = obtenerUsuariosConIntentosFallidos();
        
        foreach ($usuarios as $usuario) {
            echo '<tr>';
            echo '<td>' . $usuario->id . '</td>';
            echo '<td>' . $usuario->fullName . '</td>';
            echo '<td>' . $usuario->email . '</td>';
            
            if ($usuario->intentos_fallidos >= MAXIMOS_INTENTOS) {
                echo '<td>Bloqueado</td>';
                echo '<td><a href="desbloquear-usuario.php?id=' . $usuario->id . '">Desbloquear</a></td>';
            } else {
                echo '<td>No Bloqueado</td>';
                echo '<td>N/A</td>';
            }
            
            echo '</tr>';
        }
        ?>
    </table>
    
    <a class="back-link" href="./dashboard.php">Volver</a>
</body>
</html>

