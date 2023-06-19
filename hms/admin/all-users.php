<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
require_once('fpdf/fpdf.php');

// Consulta para obtener los usuarios por roles y búsqueda por nombre si está presente
$sql = "SELECT fullName AS nombre, lastName AS apellido, role, regDate AS fecha_creacion
        FROM users
        UNION
        SELECT first_name, last_name, role, regDate
        FROM usuarios_simulador
        UNION
        SELECT doctorName, PatLastName, role, creationDate
        FROM doctors
        UNION
        SELECT PatientName, PatLastName, role, CreationDate
        FROM tblpatient
        UNION
        SELECT username, '', role, updationDate
        FROM admin";

$search = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT fullName AS nombre, lastName AS apellido, role, regDate AS fecha_creacion
            FROM users
            WHERE fullName LIKE '%$search%'
            UNION
            SELECT first_name, last_name, role, regDate
            FROM usuarios_simulador
            WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%'
            UNION
            SELECT doctorName, PatLastName, role, creationDate
            FROM doctors
            WHERE doctorName LIKE '%$search%' OR PatLastName LIKE '%$search%'
            UNION
            SELECT PatientName, PatLastName, role, CreationDate
            FROM tblpatient
            WHERE PatientName LIKE '%$search%' OR PatLastName LIKE '%$search%'
            UNION
            SELECT username, '', role, updationDate
            FROM admin
            WHERE username LIKE '%$search%'";
}

$result = mysqli_query($con, $sql);

$users = [];
while ($row = mysqli_fetch_array($result)) {
    $users[] = $row;
}

// Crear la función que genera el archivo PDF
function generatePDF($users)
{
    // Crear el objeto FPDF
    $pdf = new FPDF();

    // Agregar una página
    $pdf->AddPage();

    // Establecer la fuente y el tamaño del título
    $pdf->SetFont('Arial', 'B', 16);

    // Escribir el título del documento PDF
    $pdf->Cell(0, 10, 'Lista de Especialistas', 0, 1, 'C');

    // Establecer la fuente y el tamaño del contenido
    $pdf->SetFont('Arial', '', 12);

    // Crear la tabla
    $pdf->Cell(10, 10, '#', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Especialidad', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Nombre de Especialista', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Apellido', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Fecha de Creacion', 1, 1, 'C');

    $cnt = 1;
    foreach ($users as $user) {
        $pdf->Cell(10, 10, $cnt, 1, 0, 'C');
        $pdf->Cell(40, 10, $user['role'], 1, 0, 'C');
        $pdf->Cell(40, 10, $user['nombre'], 1, 0, 'C');
        $pdf->Cell(40, 10, $user['apellido'], 1, 0, 'C');
        $pdf->Cell(40, 10, $user['fecha_creacion'], 1, 1, 'C');
        $cnt++;
    }

    // Generar el archivo PDF para descarga
    $pdf->Output('lista_especialistas.pdf', 'D');
}

// Verificar si se hizo clic en el botón de imprimir
if (isset($_POST['imprimir'])) {
    generatePDF($users);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Lista de Usuarios por roles</title>
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
    .imprimir-btn {
        margin-left: 80px;
        margin-top:-53px;
    }
</style>

<body>
    <div id="app">
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15">Lista de <span class="text-bold">Usuarios por roles</span></h5>
                                <p style="color:green;"><?php echo htmlentities($_SESSION['msg']);?>
                                    <?php echo htmlentities($_SESSION['msg'] = "");?></p>

                                <!-- Formulario de búsqueda -->
                                <form method="GET" action="">
                                    <div class="form-group">
                                        <input type="text" name="search" placeholder="Buscar por nombre" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </form>

                                <!-- Botón para imprimir en PDF -->
                                <form method="POST" action="">
                                    <button type="submit" name="imprimir" class="btn btn-primary imprimir-btn" target="_blank">Imprimir</button>
                                </form>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Especialidad</th>
                                                    <th>Nombre de Especialista</th>
                                                    <th>Apellido</th>
                                                    <th>Fecha de Creacion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cnt = 1;
                                                foreach ($users as $user) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php echo $user['role']; ?></td>
                                                        <td><?php echo $user['nombre']; ?></td>
                                                        <td><?php echo $user['apellido']; ?></td>
                                                        <td><?php echo $user['fecha_creacion']; ?></td>
                                                    </tr>
                                                <?php
                                                    $cnt++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="vendor/chartist/js/chartist.min.js"></script>
    <script src="assets/scripts/klorofil-common.js"></script>
</body>

</html>
