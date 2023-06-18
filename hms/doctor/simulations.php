<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

function getYouTubeVideoId($url)
{
    $videoId = "";
    $urlParts = parse_url($url);
    if (isset($urlParts['query'])) {
        parse_str($urlParts['query'], $params);
        if (isset($params['v'])) {
            $videoId = $params['v'];
        }
    }
    return $videoId;
}


$query = "SELECT id, enlace, nombre FROM simulaciones";
$result = mysqli_query($con, $query);

$simulaciones = [];
while ($row = mysqli_fetch_assoc($result)) {
    $simulaciones[] = [
        'video_id' => $row['id'],
        'video_link' => $row['enlace'],
        'video_name' => $row['nombre']
    ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Ver Pacientes</title>
    
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
    <style>
        .youtube-videos-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        .youtube-video {
            width: 300px;
            margin-right: 20px;
            margin-bottom: 20px;
        }
        .youtube-video iframe {
            width: 100%;
            height: 200px;
        }
        .youtube-video h3 {
            margin-bottom: 10px;
        }
        .youtube-video a.btn-delete {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            padding: 5px 10px;
            border-radius: 3px;
        }
    </style>
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
                                <h1 class="mainTitle">Ver Videos</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Ver Videos</span>
                                </li>
                                <li class="active">
                                    <span>Especialista</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="youtube-videos-container">
                                    <?php if(!empty($simulaciones)) : ?>
                                        <?php foreach ($simulaciones as $simulacion) : ?>
                                            <div class="youtube-video">
                                                <h3><?php echo $simulacion['video_name']; ?></h3>
                                                <?php
                                                $videoId = getYouTubeVideoId($simulacion['video_link']);
                                                if (!empty($videoId)) {
                                                    echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                                } else {
                                                    echo '<p>No se puede cargar el video.</p>';
                                                }
                                                ?>
                                                
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>No se han subido videos.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
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
