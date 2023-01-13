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
	<div class="nuevo"><a href="nueva_cat.php">Nueva Marca</a> </div>
	<div class="inicio"><a href="index.php">Volver a inicio</a> </div>
   	<div class="fecha-hoy"><?php include_once ('fecha.php'); ?>
    <br /> 
    <?php 
	echo 'Sesi&oacute;n Iniciada - '; 
    echo '<a href="logout.php">Logout</a>'; 
	?>
    </div>
    </div>

    
</div>

<h1>Administre sus Marcas</h1>



<table width="100%" border="0" cellspacing="3" cellpadding="5">
  <tr class="grey">
    <th class="col">Id</th>
    <th class="col">Categoria</th>
    <th class="col"><img src="images/borrar.png" /></th>
    <th class="col"><img src="images/editar.png" width="24" height="24" /></th>
  </tr>
 
<?php

$queEmp = "SELECT * FROM categorias ORDER BY categoria ASC";
$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);


if ($totEmp> 0) {
   while ($rowEmp = mysql_fetch_assoc($resEmp)) {
      //echo "Id: <strong>".$rowEmp['id']."</strong><br>"; 
  echo "<tr style=\"cursor:hand\" onMouseOver=\"this.style.background='#E1E1E1'; this.style.color='blue'\" onMouseOut=\"this.style.background='#FFFFFF'; this.style.color='black'\"  >";
    echo "<td class=\"col\" width=\"100\">". $rowEmp['idcat']. "</td>";
	echo "<td class=\"col\">". $rowEmp['categoria']. "</td>";
      // echo "<td class=\"col\">". $rowEmp['Fecha de Alta'] ."</td>";
    echo "<td class=\"col red-bg\" width=\"100\"><a href='borrar_categoria.php?au_id=" . $rowEmp["idcat"]." '>Borrar</a></td>";
    echo "<td class=\"col orange-bg\"  width=\"100\"><a href='editar_categoria.php?au_id=" . $rowEmp["idcat"]." '>Editar</a></td>";
  echo "</tr>";
  
   }
}
?>
  
</table>



<?php include_once ('footer.php'); ?>

</body>
</html>
<?php 
} 
?>