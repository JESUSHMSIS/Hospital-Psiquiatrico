<?php
session_start();
// Verificar si el usuario ha iniciado sesión

// Establecer la conexión con la base de datos
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'hps';
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Verificar la conexión a la base de datos
if (!$conn) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Verificar si se solicita eliminar una simulación
if (isset($_GET['delete'])) {
    $simulacionToDelete = urldecode($_GET['delete']);

    // Eliminar la simulación de la base de datos
    $query = "DELETE FROM simulaciones WHERE enlace = '$simulacionToDelete'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $message = "La simulación se ha eliminado exitosamente.";
    } else {
        $error = "Hubo un error al eliminar la simulación. Por favor, inténtalo de nuevo.";
    }
}

// Procesar la subida de la simulación si se envió el formulario
if (isset($_POST['submit'])) {
    // Obtener el enlace y el nombre de la simulación enviados en el formulario
    $simulacionLink = $_POST['video_link'];
    $simulacionName = $_POST['video_name'];

    // Verificar si se proporcionó un enlace y un nombre de simulación válidos
    if (!empty($simulacionLink) && !empty($simulacionName)) {
        // Insertar el enlace y el nombre de la simulación en la base de datos
        $query = "INSERT INTO simulaciones (enlace, nombre) VALUES ('$simulacionLink', '$simulacionName')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $message = "La simulación se ha subido exitosamente y se ha guardado en la base de datos.";
        } else {
            $error = "Hubo un error al subir la simulación. Por favor, inténtalo de nuevo.";
        }
    } else {
        $error = "Debes proporcionar un enlace válido de simulación y un nombre para la simulación.";
    }
}

// Obtener todas las simulaciones almacenadas en la base de datos
$query = "SELECT enlace, nombre FROM simulaciones";
$result = mysqli_query($conn, $query);

// Almacenar los enlaces y los nombres en un array
$simulaciones = [];
while ($row = mysqli_fetch_assoc($result)) {
    $simulaciones[] = [
        'video_link' => $row['enlace'],
        'video_name' => $row['nombre']
    ];
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
    <h1>Bienvenido, <?php echo $_SESSION['email']; ?></h1>
    
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
        <input type="text" name="video_name" placeholder="Nombre del video" required>
        <input type="text" name="video_link" placeholder="Enlace del video de YouTube" required>
        <input type="submit" name="submit" value="Subir video">
        <a href="./cerrar_sesion.php">cerrar sesion</a>
    </form>

    <!-- Mostrar los videos almacenados -->
    <h2>Videos subidos:</h2>
    <?php if (!empty($simulaciones)) : ?>
        <?php foreach ($simulaciones as $simulacion) : ?>
            <div class="youtube-video">
                <h3><?php echo $simulacion['video_name']; ?></h3>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo getYouTubeVideoId($simulacion['video_link']); ?>" frameborder="0" allowfullscreen></iframe>
                <a href="?delete=<?php echo urlencode($simulacion['video_link']); ?>">Eliminar</a>
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
