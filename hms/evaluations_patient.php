<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barras de Progreso Horizontales</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .progress-bar {
      width: 100%;
      background-color: #f2f2f2;
      border-radius: 5px;
      height: 20px;
      position: relative;
      overflow: hidden;
    }

    .progress {
      width: 0%;
      height: 100%;
      background-color: #4caf50;
      transition: width 0.5s ease-in-out;
    }

    .progress-label {
      position: absolute;
      top: -30px;
      left: 50%;
      transform: translateX(-50%);
      color: #4caf50;
      font-weight: bold;
    }

    .back-link {
      position: absolute;
      top: 10px;
      right: 10px;
      color: #4caf50;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <a href="./dashboard.php" class="back-link">volver</a>

  <div class="progress-bar">
    <div class="progress"></div>
    <div class="progress-label">50%</div>
  </div>

  <script>
    function updateProgress(progress) {
      var progressBar = document.querySelector('.progress');
      var progressLabel = document.querySelector('.progress-label');

      progressBar.style.width = progress + '%';
      progressLabel.textContent = progress + '%';
    }

    // Ejemplo de uso: actualizar el progreso al 50%
    updateProgress(50);
  </script>
</body>
</html>
