<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit']))
{   
    $simulacionLink = $_POST['video_link'];
    $simulacionName = $_POST['video_name'];

    if (!empty($simulacionLink) && !empty($simulacionName)) {
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'hps';
        $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

        if (!$conn) {
            die("Error al conectar con la base de datos: " . mysqli_connect_error());
        }

        $query = "INSERT INTO simulaciones (enlace, nombre) VALUES ('$simulacionLink', '$simulacionName')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $message = "La simulación se ha subido exitosamente y se ha guardado en la base de datos.";
        } else {
            $error = "Hubo un error al subir la simulación. Por favor, inténtalo de nuevo.";
        }

        mysqli_close($conn);
    } else {
        $error = "Debes proporcionar un enlace válido de simulación y un nombre para la simulación.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Especialista | Añadir simulación</title>
    
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

    <script>
        function userAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check_availability.php",
        data:'email='+$("#patemail").val(),
        type: "POST",
        success:function(data){
        $("#user-availability-status1").html(data);
        $("#loaderIcon").hide();
        },
        error:function (){}
        });
        }
    </script>
</head>
<body>
    <div id="app">     
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
                        
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Simulación | Añadir Simulación</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Simulación</span>
                                </li>
                                <li class="active">
                                    <span>Añadir Simulación</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Añadir Simulación</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (isset($message)) : ?>
                                                    <div class="success-message"><?php echo $message; ?></div>
                                                <?php endif; ?>

                                                <?php if (isset($error)) : ?>
                                                    <div class="error-message"><?php echo $error; ?></div>
                                                <?php endif; ?>

                                                <form role="form" name="" method="post">
                                                    <div class="form-group">
                                                        <label for="video_name">Nombre de la simulación</label>
                                                        <input type="text" name="video_name" class="form-control"  placeholder="Ingresa el nombre de la simulación" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="video_link">Enlace de la simulación</label>
                                                        <input type="text" name="video_link" class="form-control"  placeholder="Ingresa el enlace de la simulación de YouTube" required="true">
                                                    </div>

                                                    <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">Añadir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>              
            </div>
        </div>
    </div>
</body>
</html>
