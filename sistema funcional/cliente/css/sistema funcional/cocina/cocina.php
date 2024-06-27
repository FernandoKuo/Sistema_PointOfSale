<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap demo</title>
<link rel="stylesheet" href="c_styles.css" />
<script>
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>
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

  //conclude button on click
  $b = isset($_POST["b"]) ? $_POST["b"] : [];
  var_dump($b);

  for ($i = 0;$i < sizeof($b);$i++) {
    $list = $b[array_keys($b)[$i]];
    if ( isset($list) ) {
      $a = []; $b = []; $list = explode(" ", $list);
      for ($j = 0;$j < sizeof($list);$j++) {array_push($a, $list[$j]); $j++;}
      for ($j = 1;$j < sizeof($list);$j++) {array_push($b, $list[$j]); $j++;}
      for ($j = 0;$j < sizeof($a);$j++) {
        for ($l = 0;$l < (int)$b[$j];$l++) {
          $sql = "SET fecha_hora2 = CURRENT_TIMESTAMP, estado = 'concluido' 
          WHERE id_carta = '{$a[$j]}' AND estado = 'pendiente' and id_mesa = {$b[array_keys($b)[$i]]}
          LIMIT 1;";
          $conn->query($sql);
        }
      }
      break;
    }
  }

  //data sorting
  $sql = "SELECT * FROM pedido WHERE estado = 'pendiente';";
  $select = $conn->query($sql);
  $p = [];
  
  while ($row = $select->fetch_assoc()) {
    if ( !isset($p[$row["id_mesa"]]) ) {
      $p[$row["id_mesa"]] = [];
    } if ( !isset($p[$row["id_mesa"]][$row["id_carta"]]) ) {
      $p[$row["id_mesa"]][$row["id_carta"]] = 0;
    }
    $p[$row["id_mesa"]][$row["id_carta"]] += 1;
  }
  $pk = array_keys($p);
  $pkk = [];
  for ($i = 0;$i < sizeof($p);$i++) {
    $pkk[$pk[$i]] = array_keys($p[$pk[$i]]);
  }
?>

<body>

<form action="" method="post"><?php for ($i = 0;$i < sizeof($p);$i++) {$pi = $pk[$i];?>
<div style="text-align:center;margin-top:50px;"><table><tr>
  <?php for ($l = 1;$l < 4;$l++) {?><td>
    <?php for ($j = 0;$j < sizeof($p[$pi]);$j++) { $pp = $pkk[$pi][$j];
      if ( str_split((string)$pp)[0] == "{$l}" ) {
        $r = $conn->query("SELECT plato FROM carta WHERE id_carta = {$pp};"); $r = $r->fetch_assoc()["plato"];?>
        <div class="card"><?php echo "{$r} x{$p[$pi][$pkk[$pi][$j]]}";?></div>
      <?php }?>
    <?php }?></td>
  <?php }?>
  <td>
    N° Mesa<br><div style="font-size:30px"><?php echo $pi?></div>

    <?php $s = ""; for ($i = 0;$i < sizeof($p[$pi]);$i++) {$s .= $pkk[$pi][$i]. " {$p[$pi][$pkk[$pi][$i]]} ";}?>
    <button name=<?php echo "b[{$pi}]";?> value=<?php echo $s;?>>CONCLUIR</button>
  </td>
</tr></table></div>
<?php }?></form>

</body>
<?php $conn->close();?>
</html>