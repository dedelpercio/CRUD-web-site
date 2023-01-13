<?php
include_once ('links.php');
include_once ('conect.php');

if($_FILES["nueva"]["name"]==""){
		$guarProd = "UPDATE productos
		SET  codigo =  '$_POST[codigo]' , id_categoria =  '$_POST[categoria]' , 
		producto =  '$_POST[producto]' , descripcion =  '$_POST[descripcion]' , 
		imagen =  '$_POST[imagen]' , precio =  '$_POST[precio]'  , 
		fecha =  '$_POST[fecha]', destacado =  '$_POST[destacado]'  
		WHERE  id =$_POST[id];";	
		mysql_query($guarProd, $link) or die(mysql_error());
		echo "<body style=\"background:#6f6f6f\">
				<div class=\"resultado\">
					El producto se guardo correctamente!
				    <br /><br />
					<a href=\"buscar_productos_num.php?id=$_POST[id]\"> ACEPTAR </a>
				</div>
			</body>";
	}else{
	// Si la edicion contiene una imagen nueva, entonces ejecuto esta funcion
		//comprobamos si ha ocurrido un error.
		if ($_FILES["nueva"]["error"] > 0){
			echo "ha ocurrido un error";
		} else {
			//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
			//y que el tamano del archivo no exceda los 100kb
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 1000;

			if (in_array($_FILES['nueva']['type'], $permitidos) && $_FILES['nueva']['size'] <= $limite_kb * 1024){
				//esta es la ruta donde copiaremos la imagen
				//recuerden que deben crear un directorio con este mismo nombre
				$ruta = "../uploads/" . $_FILES['nueva']['name'];
				//comprobamos si este archivo existe para no volverlo a copiar.
				//pero si quieren pueden obviar esto si no es necesario.
				//o pueden darle otro nombre para que no sobreescriba el actual.
				if (!file_exists($ruta)){
					//aqui movemos el archivo desde la ruta temporal a nuestra ruta
					//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
					//almacenara true o false
					$resultado = @move_uploaded_file($_FILES["nueva"]["tmp_name"], $ruta);
					if ($resultado){
						$nombre = $_FILES['nueva']['name'];
						@mysql_query("UPDATE productos
						SET  codigo =  '$_POST[codigo]' , id_categoria =  '$_POST[categoria]' , 
						producto =  '$_POST[producto]' , descripcion =  '$_POST[descripcion]' , 
						imagen =  '$nombre' , precio =  '$_POST[precio]'  , 
						fecha =  '$_POST[fecha]', destacado =  '$_POST[destacado]'  
						WHERE  id =$_POST[id];");
						
						unlink("../uploads/$_POST[imagen]");
							echo "	<body style=\"background:#6f6f6f\">
							<div class=\"resultado\">
							El producto se guardo correctamente!
				      		<br /><br />
					  		<a href=\"buscar_productos_num.php?id=$_POST[id]\"> ACEPTAR </a>
							</div>
						</body>";
						
					} else {
						echo "ocurrio un error al cargar el archivo";
						echo "<br />";
						echo " - <a href='javascript:history.back(1)'>ACEPTAR</a>";
					}
				} else {
					?><body style="background:#6f6f6f"> <div class="error-upload-image"><img src="../uploads/<?php echo $_FILES['nueva']['name'] ?>" width="250px"/> <?php ;
					echo "Esta imagen ya existe!! 
					<br /> Por favor suba una nueva (con otro nombre en su defecto) - <a href='javascript:history.back(1)'>ACEPTAR</a></div></body>";
				}
			} else {
				echo "imagen no permitido o excede el tamano de $limite_kb Kilobytes";
				echo "<br />";
				echo " - <a href='javascript:history.back(1)'>ACEPTAR</a>";
			}
		}

}
$time=3; //seconds to wait 
sleep($time); 
?>