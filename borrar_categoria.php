<?php include_once ('conect.php'); 
$id = $_GET["au_id"];


$queEmp = "DELETE FROM categorias WHERE idcat=$id";

$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);

header('Location:categorias.php');

?>