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
	<div class="inicio"><a href="index.php">Volver a inicio</a> </div>
   	<div class="fecha-hoy"><?php include_once ('fecha.php'); ?>
    <br /> 
    <?php 
	echo 'Sesi&oacute;n Iniciada - '; 
    echo '<a href="logout.php">Logout</a>'; 
	?>
    </div>
</div>

<div class="mod-excel banner-home">
  <h1 class="tit-abm">Banner Homepage</h1>
  <form action="./includes/cargar_banner.php" method="post" id="banner_home" enctype="multipart/form-data"> 
    <table  border="0" cellspacing="5" cellpadding="5" align="center">
      <tr>
        <td class="col">Titulo</td>
        <td class="col"><input type="text" id="title" name="title"/></td>
      </tr>
      <tr>
        <td class="col">Archivo:</td>
        <td class="col"><input type="file" id="imagen" name="imagen"/></td>
      </tr>
      <tr>
        <td></td>
        <td>    <?php
      $sql = "SELECT * FROM banner_home";
      
      $consulta = mysql_query($sql);
          while ($row = mysql_fetch_assoc($consulta))
        { ?>
            <input name="old_imagen" id="old_imagen" value="<?php echo $row['img_name'] ?>" style="display:none;" /></td>
            <?php
        }
    ?>
        </td>
    </tr>
    <tr>
        <td><label name="mostrar_banner">Mostrar en pagina principal?</label></td>
        <td>
      <input type="radio" name="mostrar_banner" id="mostrar_banner" value="si">Si<input name="mostrar_banner" type="radio" id="mostrar_banner" value="no">No</td>
    
    </tr>
      <tr>
        <td colspan="2" ><input type="submit" value="Subir"  style="width:370px; float:right; text-align:center;"/></td>
      </tr>
    </table>
  </form>

  <div class="actual">
  <h3>Banner actual:</h3>
    <?php
      $sql = "SELECT * FROM banner_home";
      
      $consulta = mysql_query($sql);
          while ($row = mysql_fetch_assoc($consulta))
          {
          echo "<span class=\"item-excel\"><strong>Actualmente Activo?:</strong> ". $row['mostrar'] ."</span></br>";
          echo "<span class=\"item-excel\"><strong>Nombre:</strong> ". $row['title'] ."</span></br>";
          echo "<span class=\"item-excel\"><strong>Imagen:</strong> ";?><img src="./../uploads/banner-home/<?php echo$row['img_name']?>" width="160"></span></br> <?php
      }
    ?>
    </div>

</div>

<?php include_once ('footer.php'); ?>

</body>
</html>
<?php 
} 
?>