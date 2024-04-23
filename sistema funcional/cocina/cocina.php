<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap demo</title>
<link rel="stylesheet" href="c_styles.css" />
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
  
  $sql = "SELECT * FROM pedido WHERE estado = 'pendiente';";
  $select = $conn->query($sql);
  $result = [[/*bebidas*/], [/*platos*/], [/*postres*/]];
  
  //data sorting
  while ($row = $select->fetch_assoc()) {
    if ( str_split((string)$row["id_carta"])[0] == "1" ) {
      if ( !isset($result[0][$row["id_carta"]]) ) {
        $result[0][$row["id_carta"]] = 0;
      }
      $result[0][$row["id_carta"]] += 1;
    } elseif ( str_split((string)$row["id_carta"])[0] == "2" ) {
      if ( !isset($result[1][$row["id_carta"]]) ) {
        $result[1][$row["id_carta"]] = 0;
      }
      $result[1][$row["id_carta"]] += 1;
    } elseif ( str_split((string)$row["id_carta"])[0] == "3" ) {
      if ( !isset($result[2][$row["id_carta"]]) ) {
        $result[2][$row["id_carta"]] = 0;
      }
      $result[2][$row["id_carta"]] += 1;
    }
  }

  $reskeys = [array_keys($result[0]), array_keys($result[1]), array_keys($result[2])];

?>

<body>
<div style="border-left:5px solid #000;height:80%;position:absolute"></div>
<div style="border-left:5px solid #000;height:80%;position:absolute;left:30%"></div>
<div style="border-left:5px solid #000;height:80%;position:absolute;left:69.5%"></div>
<div style="border-left:5px solid #000;height:80%;position:absolute;left:99%"></div>

<table><tr>
  <th class="r1">PASTAS</th>
  <th class="r2">PLATOS PRINCIPALES</th>
  <th class="r3">POSTRES</th>
</tr></table>
<table><tr>
<td class="r1">
<?php for ($i = 0;$i < sizeof($result[0]);$i++) {?>
  <div><button>
    <?php 
      $r = $conn->query("SELECT plato FROM carta WHERE id_carta = '{$reskeys[0][$i]}';");
      echo $r->fetch_assoc()["plato"];
    ?>
  </button>x<?php echo $result[0][$reskeys[0][$i]]?></div>
<?php }?>
</td>
<td class="r2">
<?php for ($i = 0;$i < sizeof($result[1]);$i++) {?>
  <div><button>
    <?php 
      $r = $conn->query("SELECT plato FROM carta WHERE id_carta = '{$reskeys[1][$i]}';");
      echo $r->fetch_assoc()["plato"];
    ?>
  </button>x<?php echo $result[1][$reskeys[1][$i]]?></div>
<?php }?>
</td>
<td class="r3">
<?php for ($i = 0;$i < sizeof($result[2]);$i++) {?>
  <div><button>
    <?php 
      $r = $conn->query("SELECT plato FROM carta WHERE id_carta = '{$reskeys[2][$i]}';");
      echo $r->fetch_assoc()["plato"];
    ?>
  </button>x<?php echo $result[2][$reskeys[2][$i]]?></div>
<?php }?>
</td>
</tr></table>

<div class="des">test</div>

<?php $conn->close();?>
</body>
</html>