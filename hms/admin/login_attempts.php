<!-- admin-dashboard.php -->

<!-- Agrega esta tabla adicional para mostrar los usuarios bloqueados -->
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre de usuario</th>
      <th>Intentos</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
      // Obtener los usuarios bloqueados
      $query = "SELECT * FROM login_attempts WHERE locked = 1";
      $result = mysqli_query($con, $query);

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['attempts'] . "</td>";
        echo "<td><button onclick=\"unlockUser(" . $row['user_id'] . ")\">Desbloquear</button></td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>

<!-- Agrega el siguiente script JavaScript para manejar la acción de desbloqueo -->
<script>
  function unlockUser(userId) {
    if (confirm('¿Estás seguro de desbloquear este usuario?')) {
      // Redirige a admin-unlock-user.php para desbloquear al usuario
      window.location.href = 'admin-unlock-user.php?user_id=' + userId;
    }
  }
</script>
