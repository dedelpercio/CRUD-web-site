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
  
  ?>      
  


<h1 class="tit-abm"> Editar Producto</h1>
<form action="guardar_productos.php" method="post" id="productos" enctype="multipart/form-data"> 
<input type="text" id="id" name="id" value="<?php echo $rowEmp['id'] ?>" style="display:none;"/>
<table  border="0" cellspacing="5" cellpadding="5" align="center">
  <tr>
    <td width="90" class="col">Codigo</td>
    <td width="360" class="col"><input type="text" id="codigo" name="codigo" value="<?php echo $rowEmp['codigo'] ?>"/></td>
  </tr>
  <tr>
    <td class="col">Categoria</td>
    <td class="col">
      <select name="categoria" id="categoria"> 
      <option style="background:#999;" value="<?php echo $rowEmp['idcat'] ?>"><?php echo $rowEmp['categoria'] ?></option>
        <?php $get=mysql_query("SELECT * FROM categorias");
    while($row = mysql_fetch_assoc($get))
            {
            ?>
    <option value ="<?php echo($row['idcat'])?>"><?php echo($row['categoria'])?></option>
            <?php
            }               
        ?>
      </select>
  </td>
  </tr>
  <tr>
    <td class="col">Modelos asignados:</td>
    <td class="col">
      <label><?php echo $rowEmp['modelos'] ?></label>
      <label>- <a href="editar_modelos_prod.php?pr_id=<?php echo $rowEmp["id"]?>" style="color:blue">Modificar</a></label>
    </td>
  </tr>
  <tr>
    <td class="col">Destacado</td>
    <td class="col">
    <label>
      
   <?php   if($rowEmp['destacado'] == "si") 
{ 
    echo "<input type=\"radio\" name=\"destacado\" id=\"destacado\" value=\"si\" checked=\"checked\"/>Si";
    echo "<input name=\"destacado\" type=\"radio\" id=\"destacado\" value=\"no\" />No";
}else{
  
    echo "<input type=\"radio\" name=\"destacado\" id=\"destacado\" value=\"si\" />Si";
    echo "<input name=\"destacado\" type=\"radio\" id=\"destacado\" value=\"no\" checked=\"checked\" />No";
  
  }  ?>

    </label></td>
  </tr>
  <tr>
    <td class="col">Producto</td>
    <td class="col"> <input type="text" id="producto" name="producto"  value="<?php echo $rowEmp['producto'] ?>" /></td>
  </tr>
  <tr>
    <td class="col">Descripci&oacute;n</td>
    <td class="col"><textarea name="descripcion" rows="15"  id="descripcion"><?php echo $rowEmp['descripcion'] ?></textarea></td>
    <script type='text/javascript'>
    CKEDITOR.replace ('descripcion',
  {
    toolbar :
        [
['Bold','Italic','Underline','-',],
['FontSize'],
['Copy','Paste','PasteText','PasteFromWord'],
['SpellChecker', 'Scayt'],
['Smiley'],
['NumberedList','BulletedList'],
['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
['Undo','Redo'],
        ]

    });

  </script> 
  </tr>
  <tr>
    <td class="col">Imagen Actual:</td>
    <td class="col"><img src="../uploads/<?php echo $rowEmp['imagen']; ?> " width="150"/>
            <input name="imagen" id="imagen" value="<?php echo $rowEmp['imagen'] ?>" style="display:none;" /></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td class="col">Nueva Im&aacute;gen</td>
    <td class="col"><input type="file" name="nueva" id="nueva"/> </td>
  </tr>
  <tr>
    <td class="col">Precio</td>
    <td class="col"><input type="text" id="precio" name="precio" value="<?php echo $rowEmp['precio'] ?>" /></td>
  </tr>
  <tr>
    <td class="col">Fecha</td>
    <td class="col"><input type="text" id="datepicker" name="fecha"  value="<?php echo $rowEmp['fecha'] ?>"/></td>
  </tr>
  <tr>
    <td class="col red-bg"><a href='borrar_productos.php?pr_id=<?php echo $rowEmp["id"]?>&imagen=<?php echo $rowEmp["imagen"]?>'>Borrar</a></td>
    <td><input type="submit" value="Guardar"  style="width:370px; float:right; text-align:center;"/> </td>
  </tr>
</table>
</form>

<?php
}
  }
?>





<?php include_once ('footer.php'); ?>




<script >

$(document).ready(function() {     

$("#FORMULARIO").validate({
        rules: {
            codigo: { required: true, minlength: 1},
            producto: { required: true, minlength: 1},
            precio: { required: true, minlength: 1},
    
      
        },
        messages: {
            codigo: " - <strong style='color:#ff0000;'>completar!</strong>",            
            producto: " - <strong style='color:#ff0000;'>completar!</strong>",
      precio: " - <strong style='color:#ff0000;'>completar!</strong>",
        },
        submitHandler: function(form){
      //form.submit();
        }
    });

  }); 

</script>

</body>
</html>
<?php 
} 
?>