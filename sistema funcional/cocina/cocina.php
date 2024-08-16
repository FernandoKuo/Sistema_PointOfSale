<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap demo</title>
<link rel="stylesheet" href="c_styles.css" />
<!--<script>
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>-->
<meta http-equiv="refresh" content="">
</head>
<!--PHP for chefs-->
<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "pos";
  
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  /*
  //data sorting
  $select = $conn->query("SELECT * FROM pedido WHERE estado = 'pendiente';");
  $p = [];
  
  while ($row = $select->fetch_assoc()) {
    if ( !isset($p[$row["id_mesa"]]) ) {
      $p[$row["id_mesa"]] = [];
    } if ( !isset($p[$row["id_mesa"]][$row["id_carta"]]) ) {
      $p[$row["id_mesa"]][$row["id_carta"]] = 0;
    }
    $p[$row["id_mesa"]][$row["id_carta"]] += 1;
  }
  
  //conclude button on click
  $b = isset($_POST["b"]) ? $_POST["b"] : [];
  
  if (isset($b[0])) {
    foreach ($p as $nmesa => $ps) {if ($nmesa = (int)$b[0]) {
      foreach ($ps as $pid => $pcant) {
        $sql = "UPDATE pedido SET fecha_hora2 = CURRENT_TIMESTAMP, estado = 'concluido' WHERE id_carta = '{$pid}' AND estado = 'pendiente' and id_mesa = {$nmesa};";
        $conn->query($sql);
      }unset($pid, $pcant);
    }}unset($nmesa, $ps);
  }
  */

  $p = [];
  $select = $conn->query("select * from pedido where estado = 'pendiente' order by fecha_hora1, id_mesa, id_carta;");
  while ($row = $select->fetch_assoc()) {
    $key = $row["fecha_hora1"]." ".$row["id_mesa"];
    if ( !isset($p[$key]) ) $p[$key] = [];
    $p[$key][] = $row["id_carta"];
  }

  $b = isset($_POST["b"]) ? $_POST["b"][0] : "";
  if (isset($p[$b])) {
    $tiempo_actual = $conn->query("select CURRENT_TIMESTAMP;")->fetch_assoc()["CURRENT_TIMESTAMP"];
    for ($i = 0; $i < count($p[$b]); $i++) {
      $explosion = explode(" ", $b);
      $idcarta = $p[$b][$i];
      $idmesa = $explosion[2];
      $fh1 = $explosion[0]." ".$explosion[1];
      
      $conn->query("UPDATE pedido set fecha_hora2 = '{$tiempo_actual}', estado = 'concluido' where id_carta = '{$idcarta}' and estado = 'pendiente' and id_mesa = '{$idmesa}' and fecha_hora1 = '{$fh1}';");
    }
    unset($p[$b]);
  }
?>

<body>

<?php foreach($p as $key => $ps) { $count = 0; $newps = array_count_values($ps);?>
  <div style="text-align:center;margin-top:50px;"><table><tr>
  <?php for ($i = 1; $i <= 3; $i++) {?>
    <td>
      <?php foreach ($newps as $idcarta => $cant) {
        if ( str_split((string)$idcarta)[0] != (string)$i) {continue;}
        $r = $conn->query("select plato from carta where id_carta = '{$idcarta}';");
        $r = $r->fetch_assoc()["plato"];?>
        <div class="card"> <?php echo "{$r} x{$cant}";?> </div>
      <?php }unset($idcarta, $cant);?>
    </td>
  <?php }?>
  <td>
    <?php $separate = explode(" ", $key); echo nl2br ("{$separate[1]}\nN° mesa: {$separate[2]}");?>
    <form action="" method="post">
      <button name="b[]" value="<?php echo $key;?>">CONCLUIR</button>
    </form>
  </td>
  </tr></table></div>
<?php }unset($key, $ps);?>

<?php /* foreach ($p as $nmesa => $ps) {?>
  <div style="text-align:center;margin-top:50px;"><table><tr>
    <!--array $ps runs three times-->
    <?php for ($i = 1;$i <= 3;$i++) {?><td>
      <?php foreach ($ps as $pid => $pcant) {$s = "";
        if ( str_split((string)$pid)[0] == "{$i}" ) {
          //getting card name from database
          $r = $conn->query("SELECT plato FROM carta WHERE id_carta = {$pid};");
          $r = $r->fetch_assoc()["plato"];?>
          <!--displaying card info-->
          <div class="card"><?php echo "{$r} x{$pcant}";?></div>
        <?php }?>
      <?php }unset($pid, $pcant);?></td>
    <?php }?>
    <td>
      N° Mesa<br><div style="font-size:30px"><?php echo $nmesa?></div>

      <form action="" method="post">
        <button name="b[]" value=<?php echo $nmesa;?>>CONCLUIR</button>
      </form>
    </td>
  </tr></table></div>
<?php }unset($nmesa, $ps); */?>

</body>

<?php $conn->close();?>
</html>

