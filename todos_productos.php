<?php 
session_start(); 
include_once "conect.php"; 
include_once ('links.php');
  
function verificar_login($user,$password,&$result) { 
    $sql = "SELECT * FROM usuarios WHERE usuario = '$user' and password = '$password'"; 
    $rec = mysql_query($sql); 
    $count = 0; 
  
    while($row = mysql_fetch_object($rec)) 
    { 
        $count++; 
        $result = $row; 
    } 
  
    if($count == 1) 
    { 
        return 1; 
    } 
  
    else 
    { 
        return 0; 
    } 
} 
  
if(!isset($_SESSION['userid'])) 
{ 
    if(isset($_POST['login'])) 
    { 
        if(verificar_login($_POST['user'],$_POST['password'],$result) == 1) 
        { 
            $_SESSION['userid'] = $result->idusuario; 
            header("location:index.php"); 
        } 
        else 
        { 
            echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>'; 
        } 
    } 
?> 
  
<form action="" method="post" class="login"> 
    <div><label>Username</label><input name="user" type="text" ></div> 
    <div><label>Password</label><input name="password" type="password"></div> 
    <div><input name="login" type="submit" value="login"></div> 
</form> 
<?php 
} else { ?>

<?php include_once ('conect.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include_once ('links.php'); ?>
<title>ABM</title>
</head>

<body>

<div class="menu">
	<div class="nuevo"><a href="nuevo_producto.php">Nuevo Producto</a> </div>
	<div class="bus"><a href="productos.php">Realizar B&uacute;squeda</a> </div>
	<div class="inicio"><a href="index.php">Volver a inicio</a> </div>
   	<div class="fecha-hoy"><?php include_once ('fecha.php'); ?>
    <br /> 
    <?php 
	echo 'Sesi&oacute;n Iniciada - '; 
    echo '<a href="logout.php">Logout</a>'; 
	?>
    </div>
</div>

<h1> Todos los Productos existentes en la base de datos:</h1>




<?php
// maximo por pagina
$limit = 25;

// pagina pedida
$pag = (int) $_GET["pag"];
if ($pag < 1)
{
   $pag = 1;
}
$offset = ($pag-1) * $limit;


$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM productos AS p
JOIN categorias AS c ON p.id_categoria = c.idcat ORDER BY codigo *1 ASC LIMIT $offset, $limit";
$sqlTotal = "SELECT FOUND_ROWS() as total";

$rs = mysql_query($sql);
$rsTotal = mysql_query($sqlTotal);

$rowTotal = mysql_fetch_assoc($rsTotal);
// Total de registros sin limit
$total = $rowTotal["total"];

?>

<table width="100%" border="0" cellspacing="3" cellpadding="5">
  <tr class="grey" >
    <!--<th class="col">Id</th>-->
    <th class="col">C&oacute;digo</th>
    <th class="col">Marca</th>
    <th class="col">Modelos</th>
    <th class="col">Producto</th>
    <th class="col" width="5">Destacado</th>
    <th class="col" width="45%">Descripci&oacute;n</th>
    <th class="col">Im&aacute;gen</th>
    <th class="col">Precio</th>
    <th class="col" width="100">Fecha</th>

    <th class="col"><img src="images/borrar.png" /></th>
    <th class="col"><img src="images/editar.png" width="24" height="24" /></th>
  </tr>
 
   <tbody>
      <?php
         while ($row = mysql_fetch_assoc($rs))
         {
  echo "<tr style=\"cursor:hand\" onMouseOver=\"this.style.background='#E1E1E1'; this.style.color='blue'\" onMouseOut=\"this.style.background='#FFFFFF'; this.style.color='black'\" >";
    echo "<!--<td class=\"col\">". $row['id'] ."</td>-->";
	echo "<td class=\"col\">". $row['codigo']. "</td>";
	echo "<td class=\"col\">". $row['categoria']. "</td>";
  echo "<td class=\"col\">". $row['modelos']. "</td>";
    echo "<td class=\"col\">". $row['producto'] ."</td>";
    ?>
    <td class="col"><img src="./images/<?php echo $row['destacado']; ?>.png " width="25" height="25"/></td>
	<?php
    echo "<td class=\"col\">". $row['descripcion'] ."</td>";
	?>
    <td class="col"><img src="../uploads/<?php echo $row['imagen']; ?> " width="50"/></td>
	<?php
    echo "<td class=\"col\">$". $row['precio'] ."</td>";
    echo "<td class=\"col\">". $row['fecha'] ."</td>";
    echo "<td class=\"col red-bg\"><a href='borrar_productos.php?pr_id=". $row["id"]."&imagen=". $row["imagen"]."'>Borrar</a></td>";
    echo "<td class=\"col orange-bg\"><a href='editar_productos.php?pr_id=" . $row["id"]." '>Editar</a></td>";
  echo "</tr>";
         }
      ?>
      </tbody>
</table>
<table width="100%" border="0" cellspacing="3" cellpadding="5">
  <tbody>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="2">
        <?php
         $totalPag = ceil($total/$limit);
         $links = array();
         for( $i=1; $i<=$totalPag ; $i++)
         {
            $links[] = "<a href=\"?pag=$i\">$i</a>"; 
         }
         echo implode(" - ", $links);
      ?>
       </td>
     </tr>
   </tfoot>
</table>
<?php include_once ('footer.php'); ?>
</body>
</html>
<?php 
} 
?>