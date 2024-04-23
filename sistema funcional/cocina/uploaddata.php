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
  
  // data upload
  $nmesa = $_POST["nmesa"];
  $pedido = $_POST["p"];

  $pre_sql = "INSERT INTO `pedido` (`fecha_hora1`, `id_carta`, `id_mesa`) VALUES (CURRENT_TIMESTAMP, ";
  $pedkeys = array_keys($pedido);
  $pedkeys_size = sizeof($pedkeys);
  $nmesa = (int)$nmesa;

  for ($i =  0;$i < $pedkeys_size;$i++) {
    if ($pedido[$pedkeys[$i]] != 0) {
      $pos_sql = "{$pedkeys[$i]}, {$nmesa});";
      $sql = $pre_sql . $pos_sql;
      for ($j = 0;$j < $pedido[$pedkeys[$i]];$j++) {
        mysqli_query($conn, $sql);
      }
    }
  }
  
  /*if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
  } else {
    echo "0 results";
  }*/
  
  sleep(1);
  mysqli_close($conn);
  header("Location:../cliente/pag/menu.html");
?>

<!--hacer un html para mostrar el pedido del usuario / esperar unos segundos antes de volver-->