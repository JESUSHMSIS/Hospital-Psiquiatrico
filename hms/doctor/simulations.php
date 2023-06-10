<?php
session_start();
// Verificar si el usuario ha iniciado sesión


// Verificar si el usuario tiene el rol de "doctor"

// Establecer la conexión con la base de datos
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'hms';
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Verificar la conexión a la base de datos
if (!$conn) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Obtener todos los videos almacenados en la base de datos
$query = "SELECT youtube_link, nombre FROM simulador";
$result = mysqli_query($conn, $query);

// Almacenar los enlaces y los nombres en un array
$videos = [];
while ($row = mysqli_fetch_assoc($result)) {
    $videos[] = [
        'youtube_link' => $row['youtube_link'],
        'video_name' => $row['nombre']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simulaciones</title>
    <!-- Los enlaces a las hojas de estilo y otros recursos necesarios -->
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['id']; ?></h1>

    <!-- Mostrar los videos almacenados -->
    <h2>Simulaciones:</h2>
    <a href="./dashboard.php">volver</a>
    <?php if (!empty($videos)) : ?>
        <?php foreach ($videos as $video) : ?>
            <div class="youtube-video">
                <h3><?php echo $video['video_name']; ?></h3>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo getYouTubeVideoId($video['youtube_link']); ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No hay simulaciones disponibles.</p>
    <?php endif; ?>

    <!-- Los scripts JavaScript y otros recursos necesarios -->

    <?php
    /**
     * Obtiene el ID de video de YouTube a partir de un enlace dado.
     * @param string $url La URL del video de YouTube.
     * @return string El ID del video de YouTube.
     */
    function getYouTubeVideoId($url) {
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $params);
        return $params['v'];
    }
    ?>
</body>
</html>
