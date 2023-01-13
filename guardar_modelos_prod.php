<?php include_once ('conect.php');

$cant = $_POST['CantChecks'];
$datos = array();
$i=1;

for($i;$i <= $cant;$i++){
	if ($_POST['modelos-'.$i] == null) {
		#
	}else{
		$datos[$i] = "<div class=\"mod-item\">".$_POST["modelos-".$i]."</div>";
	}
}

while ($i < count ($datos) ) {
    print $datos[$i];
    $i++;
}

$cadena = implode(" ", $datos);
//echo $cadena;

$id = $_POST['id'];


$edMod = "UPDATE productos SET modelos='$cadena' WHERE id='$_POST[id]'";
$resMod = mysql_query($edMod, $link) or die(mysql_error());
$gCoches = mysql_num_rows($resMod);

header("Location:editar_productos.php?pr_id=".$_POST['id']."");
?>