<?php include_once ('conect.php');

$edCoches = "UPDATE categorias SET categoria= '$_GET[categoria]' where idcat='$_GET[cod]'";
 
$resCoches = mysql_query($edCoches, $link) or die(mysql_error());
$gCoches = mysql_num_rows($resCoches);


header('Location:categorias.php');


?>
