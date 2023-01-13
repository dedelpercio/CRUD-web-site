<?php
include_once ('links.php'); 
include_once ('conect.php');

//comprobamos si ha ocurrido un error.
if ($_FILES["imagen"]["error"] > 0){
echo "	<body style=\"background:#6f6f6f\">
			<div class=\"resultado\">
			Por favor, cargue una imagen!
      		<br /><br />
	  		<a href='javascript:history.back(1)'>ACEPTAR</a>
			</div>
		</body>";
	
	
} else {
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limite_kb = 1000;

	if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		//recuerden que deben crear un directorio con este mismo nombre
		//en el mismo lugar donde se encuentra el archivo subir.php
		$ruta = "../uploads/" . $_FILES['imagen']['name'];
		//comprobamos si este archivo existe para no volverlo a copiar.
		//pero si quieren pueden obviar esto si no es necesario.
		//o pueden darle otro nombre para que no sobreescriba el actual.
		if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
			if ($resultado){
				$nombre = $_FILES['imagen']['name'];
				@mysql_query("INSERT INTO productos SET codigo='$_POST[codigo]' , id_categoria='$_POST[categoria]' , producto='$_POST[producto]' , descripcion = '$_POST[descripcion]', imagen='$nombre', fecha = '$_POST[fecha]', destacado = '$_POST[destacado]' , precio = '$_POST[precio]';") ;
				$ultimo_id = mysql_insert_id($link);
				echo "	<body style=\"background:#6f6f6f\">
							<div class=\"resultado\">
							El producto se cargo correctamente!
				      		<br /><br />
					  		<a href=\"editar_productos.php?pr_id=$ultimo_id\">ACEPTAR</a>
							</div>
						</body>";

			} else {
				
				echo "	<body style=\"background:#6f6f6f\">
							<div class=\"resultado\">
							Ocurrio un error al cargar el item, vuelva a intentarlo!
				      		<br /><br />
					  		<a href='javascript:history.back(1)'>ACEPTAR</a>
							</div>
						</body>";

			}
		} else {
					?><body style="background:#6f6f6f"> <div class="error-upload-image"><img src="../uploads/<?php echo $_FILES['imagen']['name'] ?>" width="250px"/> <?php ;
					echo "Esta imagen ya existe!! 
					<br /> Por favor suba una nueva (con otro nombre en su defecto) - <a href='javascript:history.back(1)'>ACEPTAR</a></div></body>";
				}
	} else {
		
				echo "	<body style=\"background:#6f6f6f\">
							<div class=\"resultado\">
							Imagen no permitida o excede el tama&ntilde;o de $limite_kb Kilobytes!
				      		<br /><br />
					  		<a href='javascript:history.back(1)'>ACEPTAR</a>
							</div>
						</body>";

	}
}


?>