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

$username = $_POST["username"];
$psw = $_POST["psw"];
$nmesa = $_POST["nmesa"];

$sql = "select username from usuario where username = '{$username}' and psw = '{$psw}';";
$result = $conn->query($sql);
mysqli_close($conn);
sleep(1);
if ($result->num_rows === 1){
  header("Location:../menu.html?user={$username}&nmesa={$nmesa}");
} else {
  header("Location:inicio.html");
}

?>