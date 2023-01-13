<?php
include_once ('links.php'); 
include_once ('conect.php'); 

//comprobamos si ha ocurrido un error.
if ($_FILES["excel"]["error"] > 0){
echo "	<body style=\"background:#6f6f6f\">
			<div class=\"resultado\">
			Por favor, cargue un archivo!
      		<br /><br />
	  		<a href='javascript:history.back(1)'>ACEPTAR</a>
			</div>
		</body>";
	
	
} else {
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	$permitidos = array("application/vnd.ms-excel", "application/vnd.ms-excel.addin.macroenabled.12", "application/vnd.ms-excel.sheet.binary.macroenabled.12");
	$limite_kb = 1000;

	if (in_array($_FILES['excel']['type'], $permitidos) && $_FILES['excel']['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		//recuerden que deben crear un directorio con este mismo nombre
		//en el mismo lugar donde se encuentra el archivo subir.php
		$ruta = "../../uploads". $_FILES['excel']['name'];
		//comprobamos si este archivo existe para no volverlo a copiar.
		//pero si quieren pueden obviar esto si no es necesario.
		//o pueden darle otro nombre para que no sobreescriba el actual.
		if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			$resultado = @move_uploaded_file($_FILES["excel"]["tmp_name"], $ruta);
			if ($resultado){
				$nombre = $_FILES['excel']['name'];
				@mysql_query("INSERT INTO lista SET titulo='$_POST[titulo]' , archivo='$nombre', fecha = '$_POST[fecha]';") ;
				
				echo "	<body style=\"background:#6f6f6f\">
							<div class=\"resultado\">
							La lista se cargo correctamente!
				      		<br /><br />
					  		<a href=\"../index.php?\">ACEPTAR</a>
							</div>
						</body>";

			} else {
				
				echo "	<body style=\"background:#6f6f6f\">
							<div class=\"resultado\">
							No se encuentra la ruta para guardar el archivo, contáctese con el administrador!
				      		<br /><br />
					  		<a href='javascript:history.back(1)'>ACEPTAR</a>
							</div>
						</body>";

			}
		} else {
					?><body style="background:#6f6f6f"> <div class="error-upload-image">
					<?php ;
					echo "Esta lista ya existe!! 
					<br /> Por favor suba una nueva (con otro nombre en su defecto) - <a href='javascript:history.back(1)'>ACEPTAR</a></div></body>";
				}
	} else {
		
		echo"<body style=\"background:#6f6f6f\">
				<div class=\"resultado\">
					Formato de archivo no permitido o excede el tama&ntilde;o de $limite_kb Kilobytes!
		      		<br /><br />
			  		<a href='javascript:history.back(1)'>ACEPTAR</a>
				</div>
			</body>"
		;
	}
}


?>