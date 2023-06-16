<?php
session_start();

if (isset($_POST['submit'])) {
    // Verificar las credenciales del usuario aquí utilizando la base de datos
    
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hps";
    
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar si hay errores de conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    
    // Obtener los valores enviados desde el formulario de inicio de sesión
    $username = $_POST['email'];
    $password = $_POST['password'];
    
    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios_simulador WHERE email = '$username' AND password = '$password' AND estado = 1";
    $result = $conn->query($sql);
    
    // Verificar si se encontró un resultado válido
    if ($result->num_rows == 1) {
        // Credenciales válidas, iniciar sesión y redirigir al dashboard
        $_SESSION['email'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        // Credenciales inválidas, mostrar mensaje de error
        $_SESSION['errmsg'] = "Credenciales inválidas. Inténtalo de nuevo.";
        header("Location: simulador_login.php");
        exit();
    }
}

// Verificar si existe el mensaje de error 'errmsg' en el array $_SESSION
$errmsg = isset($_SESSION['errmsg']) ? $_SESSION['errmsg'] : "";

// Eliminar el mensaje de error después de usarlo
unset($_SESSION['errmsg']);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Simulador</title>
    
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
</head>
<body class="login">


<div class="row">
    <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="logo margin-top-30">
            <a href="../../index.html"><h2> HPS | Login Simulador</h2></a>
        </div>

        <div class="box-login">
            <form class="form-login" method="post">
                <fieldset>
                    <legend>
                        Inicia sesión con tu cuenta
                    </legend>
                    <p>
                        Por favor ingresa tu email y tu contraseña para iniciar sesión<br />
                        <span style="color:red;">
                            <?php
                            if ($errmsg != "") {
                                echo $errmsg;
                            }
                            ?>
                        </span>
                    </p>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                            <i class="fa fa-user"></i> </span>
                    </div>
                    <div class="form-group form-actions">
                        <span class="input-icon">
                            <input type="password" class="form-control password" name="password" placeholder="Contraseña">
                            <i class="fa fa-lock"></i>
                        </span>
                        <a href="forgot-password.php">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                    <div class="form-actions">
                        <input type="submit" name="submit" value="Iniciar Sesión" class="btn btn-primary pull-right">
                    </div>
                    
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/pace/pace.min.js"></script>
<script src="vendor/stacked-menu/stacked-menu.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="vendor/switchery/switchery.min.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>
