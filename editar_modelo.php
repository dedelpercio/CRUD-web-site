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
<title>Editar Categoria</title>
</head>
<body>

<div class="menu">
	<div class="cancelar"><a href="categorias.php">Cancelar</a> </div>
	<div class="inicio"><a href="index.php">Volver a inicio</a> </div>
   	<div class="fecha-hoy"><?php include_once ('fecha.php'); ?>
    <br /> 
    <?php 
	echo 'Sesi&oacute;n Iniciada - '; 
    echo '<a href="logout.php">Logout</a>'; 
	?>
    </div>

    
</div>




<?php 

$id = $_GET["au_id"]; 


?>



<div class="bloque-bus">
	<h2>Editar Modelo:</h2>

    	<form action="guardar_modelo.php" method="get" style="padding:10px;">
			
			
  <?php 
	$queEmp = "SELECT * FROM modelos AS m 
    JOIN categorias AS c ON m.id_categoria = c.idcat WHERE idmod='$id'";
	$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
	$totEmp = mysql_num_rows($resEmp);

	if ($totEmp> 0) {
		while ($rowEmp = mysql_fetch_assoc($resEmp))
		{
	?>            

            <input type="text" id="cod" name="cod" value="<?php echo $id ?>" style="display:none;" />
            <label><?php echo $rowEmp['categoria'] ?></label>
			<input type="text" id="nombre" name="nombre"  value="<?php echo $rowEmp['nombre'] ?>" style="width:100%;"/>

	<?php
	   }
	}
	?>


			<input type="submit" value="Guardar" class="bot-guardar"/>
		</form>

</div>

<?php include_once ('footer.php'); ?>

</body>
</html>

<?php 
} 
?>