<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_POST['submit'])) {
    $vid = $_GET['viewid'];
    $symptoms = $_POST['symptoms'];
    $diagnosis = $_POST['diagnosis'];
    $comments = $_POST['comments'];
    $rating = $_POST['rating'];

    $query = mysqli_query($con, "INSERT INTO tblpatientevaluation (PatientID, Symptoms, Diagnosis, SpecialistComments, ProgressRating) VALUES ('$vid', '$symptoms', '$diagnosis', '$comments', '$rating')");
    
    if ($query) {
        echo '<script>alert("Evaluación añadida correctamente")</script>';
        echo "<script>window.location.href ='manage-patient.php'</script>";
    } else {
        echo '<script>alert("Algo salió mal. Inténtalo de nuevo")</script>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Especialista | Lista de pacientes</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />

	</head>
    <style>
  .progress-bar {
    background-color: #007bff; /* Color de fondo de la barra de progreso */
    height: 10px; /* Altura de la barra de progreso */
  }
</style>

	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
<div class="app-content">
<?php include('include/header.php');?>
<div class="main-content" >
<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
<section id="page-title">
<div class="row">
<div class="col-sm-8">
<h1 class="mainTitle">Especialista | Lista pacientes</h1>
</div>
<ol class="breadcrumb">
<li>
<span>Especialista</span>
</li>
<li class="active">
<span>Lista pacientes</span>
</li>
</ol>
</div>
</section>
<div class="container-fluid container-fullw bg-white">
<div class="row">
<div class="col-md-12">
<h5 class="over-title margin-bottom-15">Lista de <span class="text-bold">Pacientes</span></h5>
<?php
                               $vid=$_GET['viewid'];
                               $ret=mysqli_query($con,"select * from tblpatient where ID='$vid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
                               ?>
<table border="1" class="table table-bordered">
 <tr align="center">
<td colspan="4" style="font-size:20px;color:blue">
 Datos de paciente</td></tr>

    <tr>
    <th scope>Nombre de paciente</th>
    <td><?php  echo $row['PatientName'];?></td>
    <th scope>Email Paciente</th>
    <td><?php  echo $row['PatientEmail'];?></td>
  </tr>
  <tr>
    <th scope>Numero de paciente</th>
    <td><?php  echo $row['PatientContno'];?></td>
    <th>Direccion de paciente</th>
    <td><?php  echo $row['PatientAdd'];?></td>
  </tr>
    <tr>
    <th>Genero de paciente</th>
    <td><?php  echo $row['PatientGender'];?></td>
    <th>Edad de paciente</th>
    <td><?php  echo $row['PatientAge'];?></td>
  </tr>
  <tr>
    
    <th>Historial medico de paciente</th>
    <td><?php  echo $row['PatientMedhis'];?></td>
     <th>Paciente Reg Fecha</th>
    <td><?php  echo $row['CreationDate'];?></td>
  </tr>
 
<?php }?>
</table>
<?php
$ret = mysqli_query($con, "SELECT * FROM tblpatientevaluation WHERE PatientID='$vid'");

?>

<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
    <th colspan="7">Evaluación</th>
  </tr>
  <tr>
    <th>#</th>
    <th>Síntomas</th>
    <th>Diagnóstico</th>
    <th>Comentarios del Especialista</th>
    <th>Calificación de Progreso</th>
    <th>Fecha de Visita</th>
  </tr>
  <?php
  $cnt = 1;
  while ($row = mysqli_fetch_array($ret)) {
  ?>
    <tr>
      <td><?php echo $cnt; ?></td>
      <td><?php echo $row['Symptoms']; ?></td>
      <td><?php echo $row['Diagnosis']; ?></td>
      <td><?php echo $row['SpecialistComments']; ?></td>
      <td>
  <div class="progress-bar" style="width: <?php echo $row['ProgressRating']; ?>%"></div>
</td>

      <td><?php echo $row['CreationDate']; ?></td>
    </tr>
    <?php $cnt = $cnt + 1;
  } ?>
</table>


</div>
</div>
</div>
</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
