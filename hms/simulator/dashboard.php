<?php
session_start();
// Verificar si el usuario ha iniciado sesión
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

// Verificar si se solicita eliminar un video
if (isset($_GET['delete'])) {
    $videoToDelete = urldecode($_GET['delete']);

    // Eliminar el video de la base de datos
    $query = "DELETE FROM simulador WHERE youtube_link = '$videoToDelete'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $message = "El video se ha eliminado exitosamente.";
    } else {
        $error = "Hubo un error al eliminar el video. Por favor, inténtalo de nuevo.";
    }
}

// Procesar la subida del video si se envió el formulario
if (isset($_POST['submit'])) {
    // Obtener el enlace del video enviado en el formulario
    $videoLink = $_POST['video_link'];

    // Verificar si se proporcionó un enlace de video válido
    if (!empty($videoLink) && isValidYouTubeUrl($videoLink)) {
        // Insertar el enlace del video en la base de datos
        $query = "INSERT INTO simulador (youtube_link) VALUES ('$videoLink')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $message = "El video se ha subido exitosamente y se ha guardado en la base de datos.";
        } else {
            $error = "Hubo un error al subir el video. Por favor, inténtalo de nuevo.";
        }
    } else {
        $error = "Debes proporcionar un enlace válido de video de YouTube.";
    }
}

// Obtener todos los videos almacenados en la base de datos
$query = "SELECT youtube_link FROM simulador";
$result = mysqli_query($conn, $query);

// Almacenar los enlaces en un array
$videos = [];
while ($row = mysqli_fetch_assoc($result)) {
    $videos[] = $row['youtube_link'];
}

/**
 * Verifica si una URL dada es un enlace válido de YouTube.
 * @param string $url La URL del video de YouTube.
 * @return bool true si la URL es válida, false de lo contrario.
 */
function isValidYouTubeUrl($url) {
    // Expresión regular para verificar el enlace de YouTube
    $pattern = '/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[a-zA-Z0-9_-]{11}$/';
    return preg_match($pattern, $url);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - Subir Video</title>
    <!-- Los enlaces a las hojas de estilo y otros recursos necesarios -->

    <style>
        /* Estilos CSS personalizados */
        .youtube-video {
            max-width: 560px;
        }
    </style>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>
    
    <!-- Mostrar mensajes de éxito o error -->
    <?php if (isset($message)) : ?>
        <div class="success-message"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if (isset($error)) : ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Formulario para subir videos -->
    <form action="" method="post">
        <h2>Subir un video</h2>
        <input type="text" name="video_link" placeholder="Enlace del video de YouTube" required>
        <input type="submit" name="submit" value="Subir video">
    </form>

    <!-- Mostrar los videos almacenados -->
    <h2>Videos subidos:</h2>
    <?php if (!empty($videos)) : ?>
        <?php foreach ($videos as $videoLink) : ?>
            <div class="youtube-video">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo getYouTubeVideoId($videoLink); ?>" frameborder="0" allowfullscreen></iframe>
                <a href="?delete=<?php echo urlencode($videoLink); ?>">Eliminar</a>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No se han subido videos.</p>
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
