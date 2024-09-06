<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestión de Mesas</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

echo $conn->query("select max(id_pago) from pago;")->fetch_assoc()['max(id_pago)'];

?>

<div class="container">
  <h1>Gestión de Mesas</h1>
  <table>
    <thead>
      <tr>
        <th>Número de Mesa</th>
        <th>Estado</th>
        <th>Dinero Acumulado</th>
        <th>Pago Realizado</th>
      </tr>
    </thead>
    <tbody>
      <!-- Estas filas deben ser generadas dinámicamente con PHP según la cantidad de mesas -->
      <tr>
        <td>Mesa 1</td>
        <td class="active">Activa</td>
        <td>$120.00</td>
        <td class="paid">Sí</td>
      </tr>
      <tr>
        <td>Mesa 2</td>
        <td class="reserved">Reservada</td>
        <td>$0.00</td>
        <td class="not-paid">No</td>
      </tr>
      <tr>
        <td>Mesa 3</td>
        <td class="inactive">Inactiva</td>
        <td>$80.00</td>
        <td class="paid">Sí</td>
      </tr>
      <!-- Agrega más filas según la cantidad de mesas -->
    </tbody>
  </table>
</div>
</body>
</html>