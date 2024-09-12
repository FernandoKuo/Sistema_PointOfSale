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

//pendiente
$p = [];
$s1 = $conn->query("select * from pago where estado = 'pendiente';");
while ($row = $s1->fetch_assoc()) {
  $key = $row["id_pago"];
  if ( !isset($p[$key]) ) {$p[$key] = [];}
  //get total money
  $total = 0;
  $s2 = $conn->query("select id_carta from pedido where id_pago = {$key};");
  while ($idc = $s2->fetch_assoc()) {
    $pepe = $idc['id_carta'];
    $total += $conn->query("select importe from carta where id_carta = {$pepe}")->fetch_assoc()['importe'];
  }

  $p[$key][0] = $row['id_mesa'];
  $p[$key][1] = $row['id_usuario'];
  $p[$key][2] = $total;
}

//concluido
$pi = [];
$s3 = $conn->query("select * from pago where estado = 'concluido';");
while ($row = $s3->fetch_assoc()) {
  $key = $row["id_pago"];
  if ( !isset($pi[$key]) ) {$pi[$key] = [];}
  //get total money
  $total = 0;
  $s4 = $conn->query("select id_carta from pedido where id_pago = {$key};");
  while ($idc = $s4->fetch_assoc()) {
    $pepe = $idc['id_carta'];
    $total += $conn->query("select importe from carta where id_carta = {$pepe}")->fetch_assoc()['importe'];
  }

  $pi[$key][0] = $row['id_mesa'];
  $pi[$key][1] = $row['id_usuario'];
  $pi[$key][2] = $total;
}

//button
$b = isset($_POST["b"]) ? $_POST["b"][0] : "";
if (isset($p[$b])) {
  $conn->query("update pago set estado = 'concluido' where id_pago = {$b};");
  unset($p[$b]);
  header("Refresh:0");
}

?>

<div class="container">
  <h1>Gestión de Mesas</h1>
  <table>
    <thead>
      <tr>
        <th>ID Pago</th>
        <th>Numero de Mesa</th>
        <th>ID Usuario</th>
        <th>Importe</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($p as $key => $ps) {?>
        <tr>
          <td><?php echo $key;?></td>
          <td><?php echo $ps[0];?></td>
          <td><?php echo $ps[1];?></td>
          <td><?php echo $ps[2];?></td>
          <td>PENDIENTE</td>
          <td><form action="" method="post"><button name="b[]" value="<?php echo $key;?>">PAGAR</button></form></td>
        </tr>
      <?php } unset($key, $ps);?>
    </tbody>
  </table>
  <br>

  <table>
    <thead>
      <tr>
        <th>ID Pago</th>
        <th>Numero de Mesa</th>
        <th>ID Usuario</th>
        <th>Importe</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($pi as $key => $ps) {?>
      <tr>
        <td><?php echo $key;?></td>
        <td><?php echo $ps[0];?></td>
        <td><?php echo $ps[1];?></td>
        <td><?php echo $ps[2];?></td>
        <td>CONCLUIDO</td>
        <td><button name="b[]" value="<?php echo $key;?>">PAGAR</button></td>
      </tr>
    <?php } unset($key, $ps);?>
    </tbody>
  </table>
</div>
</body>
</html>