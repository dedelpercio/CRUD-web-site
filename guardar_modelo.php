<?php include_once ('conect.php');

$edCoches = "UPDATE modelos SET nombre= '$_GET[nombre]' where idmod='$_GET[cod]'";
 
$resCoches = mysql_query($edCoches, $link) or die(mysql_error());
$gCoches = mysql_num_rows($resCoches);


header('Location:modelos.php');


?>
