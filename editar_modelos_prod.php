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
<script type=text/javascript src=./ckeditor/ckeditor.js></script>
<?php  $id = $_GET["pr_id"]; ?>
<title>ABM - SENESA</title>
</head>
<body>

<div class="menu">
  <div class="cancelar"><a href="javascript:history.go(-1)">Cancelar</a> </div>
  <div class="inicio"><a href="index.php">Volver a inicio</a> </div>
    <div class="fecha-hoy"><?php include_once ('fecha.php'); ?>
    </br>
      <?php 
        echo 'Sesi&oacute;n Iniciada - '; 
        echo '<a href="logout.php">Logout</a>'; 
      ?>
    </div>
</div>


 
<?php

  $queEmp = "SELECT * FROM productos AS p JOIN categorias AS c ON p.id_categoria = c.idcat WHERE id='$id'";
  $resEmp = mysql_query($queEmp, $link) or die(mysql_error());
  $totEmp = mysql_num_rows($resEmp);

  if ($totEmp> 0) {
    while ($rowEmp = mysql_fetch_assoc($resEmp))
    {
  
      //echo "Id: <strong>".$rowEmp['id']."</strong><br>"; 
      $idcatmod = $rowEmp['id_categoria'];
      $idprod = $rowEmp['id'];
  
  ?>      
  


<h1 class="tit-abm">Asignar Modelos a Producto Seleccionado</h1>
<form action="guardar_modelos_prod.php" method="post" id="productos" enctype="multipart/form-data"> 
<input type="text" id="id" name="id" value="<?php echo $rowEmp['id'] ?>" style="display:none;"/>
<table  border="0" cellspacing="5" cellpadding="5" align="center">
  <tr>
    <td width="90" class="col">Codigo de Producto</td>
    <td width="360" class="col">
      <label ><?php echo $rowEmp['codigo'] ?></label></td>
  </tr>
  <tr>
    <td class="col">Categoria del Producto</td>
    <td class="col">
      <label><?php echo $rowEmp['categoria'] ?></label>
  </td>
  </tr>
  <tr>
    <td class="col">Asignar Modelos:</td>
    <td class="col checks">
    <?php $get=mysql_query("SELECT * FROM modelos WHERE id_categoria='$idcatmod'");

    while($row = mysql_fetch_assoc($get))
        {

    $nombres = $row['nombre'];
    $valores_encadenados = $nombres; 
    $valor_array = explode(',',$valores_encadenados);
    $CantMod = 1;
    foreach($valor_array as $llave => $valores) 
        { 
          //echo $valores . "<br />"; 
          echo "<input type=\"checkbox\" name=\"modelos-".$CantMod."\" id=\"modelos-".$CantMod."\" value =\"".$valores."\">".$valores." <br>";
          $CantMod++;
        }
      }               
    ?>
    </td>
  </tr>
  <tr>
    <td><input type="submit" value="Guardar"  style="width:370px; float:right; text-align:center;"/> </td>
  </tr>
</table>
<input type="text" id="CantChecks" name="CantChecks" value="" style="display:none">
</form>

<?php
}
  }
?>
<?php include_once ('footer.php'); ?>

<script type="text/javascript">

$( document ).ready(function() {
    $valor = $('.checks > input').length;
    $('#CantChecks').val($valor);
});
</script>

</body>
</html>
<?php 
} 
?>