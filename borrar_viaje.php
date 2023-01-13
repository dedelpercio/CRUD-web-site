<?php include_once ('conect.php'); 

$id = $_GET["vi_id"];

$queEmp = "DELETE FROM viajes WHERE id=$id";

$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);

header ("Location:todos_viajes.php?pag=1");

?>