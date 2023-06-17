<?php
include_once('include/config.php');
if(isset($_POST['submit']))
{
$fname=$_POST['full_name'];
$last_name = $_POST['last_name'];
$middle_name= $_POST['middle_name'];
$ci=$_POST['ci'];
$address=$_POST['address'];
$city=$_POST['city'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$query=mysqli_query($con,"insert into users(fullname,lastName,middleName,ci,address,city,gender,email,password) values('$fname','$last_name','$middle_name','$ci','$address','$city','$gender','$email','$password')");
if($query)
{
	echo "<script>alert('Registrado correctamente. Ahora inicia sesion!!');</script>";
	//header('location:user-login.php');
}
}
?>


<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Registro de Usuario</title>
		
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
		
		<script type="text/javascript">
        function valid() {
            if (document.registration.password.value != document.registration.password_again.value) {
                alert("Contraseña o confirmación de contraseña no coinciden!!");
                document.registration.password_again.focus();
                return false;
            }

            // Validar correo electrónico
            var email = document.registration.email.value;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Por favor, ingresa un correo electrónico válido");
                document.registration.email.focus();
                return false;
            }

            return true;
        }
    </script>
		

	</head>

	<body class="login">
		<!-- start: REGISTRATION -->
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				<a href="../index.html"><h2>HPS | Registro de Paciente</h2></a>
				</div>
				<!-- start: REGISTER BOX -->
				<div class="box-register">
				<form name="registration" id="registration" method="post" onSubmit="return valid();">
    <fieldset>
        <legend>Regístrate</legend>
        <p>Ingresa tus datos personales:</p>
        <div class="form-group">
            <input type="text" class="form-control" name="full_name" placeholder="Nombre" pattern="[A-Za-z\s]+" title="Solo se permiten letras" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="last_name" placeholder="Apellido Paterno" pattern="[A-Za-z\s]+" title="Solo se permiten letras" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="middle_name" placeholder="Apellido Materno" pattern="[A-Za-z\s]+" title="Solo se permiten letras" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="ci" placeholder="Ingresa tu número de carnet" pattern="[0-9]+" title="Solo se permiten números" minlength="8" maxlength="10" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="address" placeholder="Dirección" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="city" placeholder="Ciudad" required>
        </div>
        <div class="form-group">
            <label class="block">Género</label>
            <div class="clip-radio radio-primary">
                <input type="radio" id="rg-female" name="gender" value="femenino" required>
                <label for="rg-female">Femenino</label>
                <input type="radio" id="rg-male" name="gender" value="masculino" required>
                <label for="rg-male">Masculino</label>
            </div>
        </div>
        <p>Ingresa datos para tu cuenta:</p>
        <div class="form-group">
            <span class="input-icon">
                <input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()" placeholder="Email" required>
                <i class="fa fa-envelope"></i>
            </span>
            <span id="user-availability-status1" style="font-size:12px;"></span>
        </div>
        <div class="form-group">
    <span class="input-icon">
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" pattern="^(?=.*\d)(?=.*[A-Z]).+$" title="La contraseña debe contener al menos un número y una letra mayúscula" required>
        <i class="fa fa-lock"></i>
    </span>
</div>
<div class="form-group">
    <span class="input-icon">
        <input type="password" class="form-control" id="password_again" name="password_again" placeholder="Confirmar contraseña" required>
        <i class="fa fa-lock"></i>
    </span>
</div>

        <div class="form-group">
            <div class="checkbox clip-check check-primary">
                <input type="checkbox" id="agree" value="agree" checked="true" readonly="true" required>
                <label for="agree">Estoy de acuerdo</label>
            </div>
        </div>
        <div class="form-actions">
            <p>¿Ya tienes una cuenta? <a href="user-login.php">Iniciar Sesión</a></p>
            <button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">Enviar <i class="fa fa-arrow-circle-right"></i></button>
        </div>
    </fieldset>
</form>

					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> HPS</span>. <span>Todos los derechos reservados</span>
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
		
	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>	
		
	</body>
	<!-- end: BODY -->
</html>