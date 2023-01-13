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
	<div class="nuevo"><a href="nuevo_producto.php">Cargar Nuevo Producto</a> </div>
	<div class="bus"><a href="productos.php">Realizar otra B&uacute;squeda</a> </div>
	<div class="inicio"><a href="index.php">Volver a inicio</a> </div>
   	<div class="fecha-hoy"><?php include_once ('fecha.php'); ?>
    <br /> 
    <?php 
	echo 'Sesi&oacute;n Iniciada - '; 
    echo '<a href="logout.php">Logout</a>'; 
	?>
    </div>
</div>

<table width="100%" border="0" cellspacing="3" cellpadding="5">
  <tr class="grey" >
    <!--<th class="col">Id</th>-->
    <th class="col">C&oacute;digo</th>
    <th class="col">Categoria</th>
    <th class="col">Modelos</th>
    <th class="col">Titulo</th>
    <th class="col" width="5">Destacado</th>
    <th class="col" width="45%">Descripci&oacute;n</th>
    <th class="col">Im&aacute;gen</th>
    <th class="col">Precio</th>
    <th class="col" width="100">Fecha</th>
    <th class="col"><img src="images/borrar.png" /></th>
    <th class="col"><img src="images/editar.png" width="24" height="24" /></th>
  </tr>
 
<?php

$queEmp = "SELECT * FROM productos AS p
JOIN categorias AS c ON p.id_categoria = c.idcat WHERE id='$_GET[id]';";
$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);


if ($totEmp> 0) {
   while ($rowEmp = mysql_fetch_assoc($resEmp)) {
      //echo "Id: <strong>".$rowEmp['id']."</strong><br>"; 
  echo "<tr>";
  
	echo "<td class=\"col\">". $rowEmp['codigo']. "</td>";
    echo "<td class=\"col\">". $rowEmp['categoria'] ."</td>";
    echo "<td class=\"col\">". $rowEmp['modelos'] ."</td>";
	echo "<td class=\"col\">". $rowEmp['producto'] ."</td>";
    ?>
    <td class="col"><img src="./images/<?php echo $rowEmp['destacado']; ?>.png " width="25" height="25"/></td>
	<?php
	
	echo "<td class=\"col\">". $rowEmp['descripcion'] ."</td>";
	?>
    <td class="col"><img src="../uploads/<?php echo $rowEmp['imagen']; ?> " width="50"/></td>
	<?php
    echo "<td class=\"col\">$". $rowEmp['precio'] ."</td>";
    echo "<td class=\"col\">". $rowEmp['fecha'] ."</td>";
    echo "<td class=\"col red-bg\"><a href='borrar_productos.php?pr_id=" . $rowEmp["id"]." '>Borrar</a></td>";
    echo "<td class=\"col orange-bg\"><a href='editar_productos.php?pr_id=" . $rowEmp["id"]." '>Editar</a></td>";
  echo "</tr>";
  
   }
}
?>
  
</table>
<a href="todos_productos.php?pag=1">Ver todos los productos</a>
<?php include_once ('footer.php'); ?>

</body>
</html>
<?php 
} 
?>