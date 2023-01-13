<?php

include_once ('conect.php');

$cargarCat = "	INSERT INTO modelos SET id_categoria= '$_GET[id_categoria]', nombre= '$_GET[nombre]';";

mysql_query($cargarCat, $link) or die(mysql_error());

header('Location:modelos.php');
echo "</br>" . " La carga fue exitosa </br>";
echo "<a href='modelos.php'>volver</a>";

?>