<div class="menu">
	<div class="inicio"><a href="index.php">inicio</a> </div>
  <!--<div class="coches"><a href="banner_home.php">Banner</a></div>-->
  <div class="coches"><a href="categorias.php">Marcas</a><br /> </div>
  <div class="coches"><a href="modelos.php">Modelos</a><br /> </div>
	<div class="bus"><a href="productos.php">Productos</a></div>  
    
  <div class="fecha-hoy"><?php include_once ('fecha.php'); ?>
    <br /> 

  <?php 
    echo 'Sesi&oacute;n Iniciada - '; 
    echo '<a href="logout.php">Logout</a>'; 
	?>
  </div>

    
</div>