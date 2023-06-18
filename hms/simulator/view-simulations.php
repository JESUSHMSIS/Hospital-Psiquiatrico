<?php
session_start();
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'hps';
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
    $simulacionToDelete = urldecode($_GET['delete']);
    $query = "DELETE FROM simulaciones WHERE enlace = '$simulacionToDelete'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $message = "La simulación se ha eliminado exitosamente.";
    } else {
        $error = "Hubo un error al eliminar la simulación. Por favor, inténtalo de nuevo.";
    }
}

$query = "SELECT enlace, nombre FROM simulaciones";
$result = mysqli_query($conn, $query);

$simulaciones = [];
while ($row = mysqli_fetch_assoc($result)) {
    $simulaciones[] = [
        'video_link' => $row['enlace'],
        'video_name' => $row['nombre']
    ];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - Ver Simulaciones</title>
    <style>
        /* Estilos CSS personalizados */
        .youtube-videos-container {
            display: flex;
            flex-wrap: wrap;
        }

        .youtube-video {
            width: 560px;
            margin-right: 20px;
            margin-bottom: 20px;
        }

        .youtube-video iframe {
            width: 100%;
            height: 315px;
        }
    </style>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['email']; ?></h1>

    <?php if (isset($message)) : ?>
        <div class="success-message"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if (isset($error)) : ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <h2>Videos subidos:</h2>
    <div class="youtube-videos-container">
        <?php if (!empty($simulaciones)) : ?>
            <?php foreach ($simulaciones as $simulacion) : ?>
                <div class="youtube-video">
                    <h3><?php echo $simulacion['video_name']; ?></h3>
                    <iframe src="https://www.youtube.com/embed/<?php echo getYouTubeVideoId($simulacion['video_link']); ?>" frameborder="0" allowfullscreen></iframe>
                    <a href="?delete=<?php echo urlencode($simulacion['video_link']); ?>">Eliminar</a>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No se han subido videos.</p>
        <?php endif; ?>
    </div>

    <a href="./dashboard.php">volver</a>

    <!-- Los scripts JavaScript y otros recursos necesarios -->

    <?php
    function getYouTubeVideoId($url) {
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $params);
        return $params['v'];
    }
    ?>
</body>
</html>
