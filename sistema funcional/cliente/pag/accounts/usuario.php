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
$sql = "select username from usuario where username = {$username}";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    echo '<script>alert("Nombre de usuario ya existe")</script>';
    sleep(3);
    header("Location:registro.html");
}

//main
$sql = "insert into usuario (nombre, apellido, username, dni, tel, email, psw) values ( {$nombre}, {$apellido}, {$username}, {$dni}, {$tel}, {$email}, {$password} )";

mysqli_query($conn, $sql);

header("Location:inicio.html")
?>