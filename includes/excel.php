<div class="mod-excel">
  <h1 class="tit-abm">Catalogo (PDF)</h1>
  <form action="./includes/cargar_archivo.php" method="post" id="excel" enctype="multipart/form-data"> 
    <table  border="0" cellspacing="5" cellpadding="5" align="center">
      <tr>
        <td class="col">Titulo</td>
        <td class="col"><input type="text" id="titulo" name="titulo"/></td>
      </tr>
      <tr>
        <td class="col">Archivo:</td>
        <td class="col"><input type="file" id="excel" name="excel"/></td>
      </tr>
      <tr>
        <td class="col">Fecha</td>
        <td class="col"><input type="text" id="datepicker" name="fecha" class="datepicker" /></td>
      </tr>
      <tr>
        <td colspan="2" ><input type="submit" value="Subir"  style="width:370px; float:right; text-align:center;"/></td>
      </tr>
    </table>
  </form>
  <div class="actual">
  <h3>Lista actual:</h3>
    <?php
      $sql = "SELECT * FROM lista";
      
      $consulta = mysql_query($sql);
          while ($row = mysql_fetch_assoc($consulta))
          {
          echo "<span class=\"item-excel\"><strong>Nombre:</strong> ". $row['titulo'] ."</span></br>";
          echo "<span class=\"item-excel\"><strong>Archivo:</strong> ";?><a href="../listas/<?php echo$row['archivo']?>"><?php echo$row['archivo']?></a></span></br> <?php
          echo "<span class=\"item-excel\"><strong>Ultima actualización:</strong> ". $row['fecha'] ."</span></br>";
      }
    ?>
    </div>
</div>

<div class="mod-excel">
  <h1 class="tit-abm">Lista de SUSPENSIÓN (excel)</h1>
  <form action="./includes/cargar_archivo_sus.php" method="post" id="excel" enctype="multipart/form-data"> 
    <table  border="0" cellspacing="5" cellpadding="5" align="center">
      <tr>
        <td class="col">Titulo</td>
        <td class="col"><input type="text" id="titulo" name="titulo"/></td>
      </tr>
      <tr>
        <td class="col">Archivo:</td>
        <td class="col"><input type="file" id="excel" name="excel"/></td>
      </tr>
      <tr>
        <td class="col">Fecha</td>
        <td class="col"><input type="text" id="datepicker_sus" name="fecha" class="datepicker" /></td>
      </tr>
      <tr>
        <td colspan="2" ><input type="submit" value="Subir"  style="width:370px; float:right; text-align:center;"/></td>
      </tr>
    </table>
  </form>
  <div class="actual">
  <h3>Lista actual:</h3>
    <?php
      $sql = "SELECT * FROM lista_sus";
      
      $consulta = mysql_query($sql);
          while ($row = mysql_fetch_assoc($consulta))
          {
          echo "<span class=\"item-excel\"><strong>Nombre:</strong> ". $row['titulo'] ."</span></br>";
          echo "<span class=\"item-excel\"><strong>Archivo:</strong> ";?><a href="../listas/<?php echo$row['archivo']?>"><?php echo$row['archivo']?></a></span></br> <?php
          echo "<span class=\"item-excel\"><strong>Ultima actualización:</strong> ". $row['fecha'] ."</span></br>";
      }
    ?>
    </div>
</div>



<script>

$().ready(function() {
  $("#datepicker_sus").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd/mm/yy",
    onSelect: function(dateText, inst) { 
    $("#datepicker_sus").val(dateText);
    }
  });
});
</script>