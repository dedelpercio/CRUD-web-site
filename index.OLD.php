<link rel=StyleSheet href="style/login.css" type="text/css" media=screen>
<?php
session_start();
include_once "conect.php";  
function verificar_login($user,$password,&$result){
    $sql = "SELECT * FROM usuarios WHERE usuario = '$user' and password = '$password'";
    $rec = mysql_query($sql);
    $count = 0;
    while($row = mysql_fetch_object($rec)){
        $count++;
        $result = $row;
    }
    if($count == 1){
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
            header('location:index.php');
        }
        else
        {
            echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
        }
    }
?>

<style type="text/css">

*{ 
    font-size: 14px; 
} 

body{ 
background:#aaa; 
} 

</style>

<div class="backend">
    <div class="logo">
        <img src="./images/logo-backend.png">
    </div>

    <form action="" method="post" class="login"> 
        <div><label>Usuario:</label><input name="user" type="text" ></div> 
        <div><label>Contrase&ntilde;a:</label><input name="password" type="password"></div> 
        <div class="login-button"><input name="login" type="submit" value="login"></div> 
    </form> 
</div>
<?php
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include_once ('links.php'); ?>
<title>ABM</title>
</head>
<body>
    <?php include_once ('menu.php'); ?>
    <h1> Bienvenido a su ABM </h1>
    <p>Seleccione una opci&oacute;n del men&uacute; de arriba para comenzar a gestionar sus contenidos.</p>
    <?php include_once ('./includes/excel.php'); ?>
    <?php include_once ('footer.php'); ?>
</body>
</html>
<?php
}
?>