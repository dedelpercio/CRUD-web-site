<?php
include_once ('links.php'); 
include_once ('conect.php'); 

if($_FILES["nueva"]["name"]=="")
	{
	// si la edicion NO contiene una imagen nueva, ejecuto el siguiente sql
		$guarProd = "UPDATE  clientes SET  titulo =  '$_POST[titulo]' , descripcion =  '$_POST[descripcion]'   WHERE  id =$_POST[id];";
		mysql_query($guarProd, $link) or die(mysql_error());
		header ("Location: clientes.php?pag=1");
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
				//en el mismo lugar donde se encuentra el archivo subir.php
				$ruta = "../clientes/" . $_FILES['nueva']['name'];
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
						@mysql_query("UPDATE  clientes SET  titulo =  '$_POST[titulo]' , descripcion =  '$_POST[descripcion]' , imagen =  '$nombre'  WHERE  id =$_POST[id];") ;
						
					
				echo "	<body style=\"background:#6f6f6f\">
							<div class=\"resultado\">
							El cliente se guardo correctamente!
				      		<br /><br />
					  		<a href=\"clientes.php?pag=1\"> ACEPTAR </a>
							</div>
						</body>";
						
					} else {
				echo "	<body style=\"background:#6f6f6f\">
							<div class=\"resultado\">
							ocurrio un error al cargar el archivo
				      		<br /><br />
					  		<a href='javascript:history.back(1)'>ACEPTAR</a>
							</div>
						</body>";
						
						
					}
				} else {
						$nombre = $_FILES['nueva']['name'];
						@mysql_query("UPDATE  clientes SET  titulo =  '$_POST[titulo]' , descripcion =  '$_POST[descripcion]' , imagen =  '$nombre'  WHERE  id =$_POST[id];") ;
						
					
				echo "	<body style=\"background:#6f6f6f\">
							<div class=\"resultado\">
							El Cliente se guardo correctamente!
				      		<br /><br />
					  		<a href=\"clientes.php?pag=1\"> ACEPTAR </a>
							</div>
						</body>";
						
						
				}
			} else {
				
				echo "	<body style=\"background:#6f6f6f\">
							<div class=\"resultado\">
							imagen no permitido o excede el tamano de $limite_kb Kilobytes
				      		<br /><br />
					  		<a href='javascript:history.back(1)'>ACEPTAR</a>
							</div>
						</body>";
				
			}
		}

}

$time=3; //seconds to wait 
sleep($time); 

?>