<?php include_once ('conect.php'); 
$id = $_GET["pr_id"];
$imagen = $_GET["imagen"];

$queEmp = "DELETE FROM productos WHERE id=$id";

$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);

unlink("../uploads/$imagen");
header('Location:todos_productos.php?pag=1');

?>