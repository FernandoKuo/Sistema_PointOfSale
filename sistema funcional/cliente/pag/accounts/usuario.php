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

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$username = $_POST["username"];
$dni = $_POST["dni"];
$tel = $_POST["tel"];
$email = $_POST["email"];
$password = $_POST["password"];

// check if repeated username
$sql = "select id_usuario from usuario where username = {$username};";
$result = $conn->query($sql);
sleep(1);
if ($result->num_rows === 0){
  //main
  $sql = "insert into `usuario` (`nombre`, `apellido`, `username`, `dni`, `tel`, `email`, `psw`) values ( '{$nombre}', '{$apellido}', '{$username}', {$dni}, '{$tel}', '{$email}', '{$password}' );";

  mysqli_query($conn, $sql);

  mysqli_close($conn);
  header("Location:inicio.html");
} else {
  mysqli_close($conn);
  header("Location:registro.html");
}
?>