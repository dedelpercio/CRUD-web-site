<?php

include_once ('conect.php');

$cargarCat = "	INSERT INTO categorias SET categoria= '$_GET[categoria]';";

mysql_query($cargarCat, $link) or die(mysql_error());

header('Location:categorias.php');
echo "</br>" . " La carga fue exitosa </br>";
echo "<a href='categorias.php'>volver</a>";

?>