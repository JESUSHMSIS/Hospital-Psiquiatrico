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
?>




<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login Usuario</title>
		
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
				<a href="../index.html"><h2> HPS | Login Paciente</h2></a>
				</div>

				<div class="box-login">
					<form class="form-login" method="post">
						<fieldset>
							<legend>
								Inicia sesion con tu cuenta
							</legend>
							<p>
								Porfavor ingresa tu email y tu contraseña para Iniciar Sesion<br />
								<span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="username" placeholder="Email">
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Contraseña">
									<i class="fa fa-lock"></i>
									 </span><a href="forgot-password.php">
									Olvidaste tu contraseña?
								</a>
							</div>
							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" name="submit">
									Iniciar sesion <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							<div class="new-account">
								No tienes una cuenta?
								<a href="registration.php">
									Crea tu cuenta
								</a>
							</div>
						</fieldset>
					</form>

					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> HPS</span>. <span>Todos los derechos reservados Marraquetas 2.0</span>
					</div>
			
				</div>

			</div>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	
		<script src="assets/js/main.js"></script>

		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	
	</body>
	<!-- end: BODY -->
</html>