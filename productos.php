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
	<div class="bus"><a href="todos_productos.php?pag=1">Ver todos</a> </div>
	<div class="inicio"><a href="index.php">Volver a inicio</a> </div>
   	<div class="fecha-hoy"><?php include_once ('fecha.php'); ?>
    <br /> 
    <?php 
	echo 'Sesi&oacute;n Iniciada - '; 
    echo '<a href="logout.php">Logout</a>'; 
	?>
    </div>
</div>

<h1>Buscar productos cargados:</h1>
<P>En esta secci&oacute;n vas a poder ver todos los contenidos guardados en la base de datos, como asi tambien crear nuevos y editar los existentes. </P>


<div class="bloque-bus">
	<h2>BUSCAR POR FECHA:</h2>
	<form action="buscar_productos.php" method="get"  style="padding:10px;">
		<input type="text" id="datepicker" name="fecha" />
		<input type="submit" value="Buscar" />
	</form>
</div>


<div class="bloque-bus">
	<h2>BUSCAR POR CODIGO:</h2>
	<form action="buscar_productos_codigo.php" method="get" style="padding:10px;">
		<input type="Text" id="codigo" name="codigo">
		<input type="submit" value="Buscar" />
	</form>
</div>

<div class="bloque-bus">
	<h2>BUSCAR POR MARCA:</h2>
	<form action="buscar_productos_cat.php" method="get" style="padding:10px;">
		<select name="categoria" id="categoria"> 
		<option value="No Asignado">---------</option>
       		<?php $get=mysql_query("SELECT categoria FROM categorias ORDER BY categoria ASC");
			while($row = mysql_fetch_assoc($get))
            {
            ?>
		<option value = "<?php echo($row['categoria'])?>" > <?php echo($row['categoria'])?></option>
           	<?php
           	}               
        	?>
		</select>
		<input type="submit" value="Buscar" />
	</form>
</div>

<?php include_once ('footer.php'); ?>

</body>
</html>
<?php 
} 
?>