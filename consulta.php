


<?php
// maximo por pagina
$limit = 25;

// pagina pedida
$pag = (int) $_GET["pag"];
if ($pag < 1)
{
   $pag = 1;
}
$offset = ($pag-1) * $limit;


$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM viajes LIMIT $offset, $limit";
$sqlTotal = "SELECT FOUND_ROWS() as total";

$rs = mysql_query($sql);
$rsTotal = mysql_query($sqlTotal);

$rowTotal = mysql_fetch_assoc($rsTotal);
// Total de registros sin limit
$total = $rowTotal["total"];

?>

<table width="100%" border="0" cellspacing="3" cellpadding="5">
  <tr class="grey" >
    <th class="col">Id</th>
    <th class="col">C&oacute;digo</th>
    <th class="col">Categoria</th>
    <th class="col">Producto</th>
    <th class="col">Descripci&oacute;n</th>
    <th class="col">Im&aacute;gen</th>
    <th class="col">Precio</th>
    <th class="col">Fecha</th>
    <th class="col"><img src="images/borrar.png" /></th>
    <th class="col"><img src="images/editar.png" width="24" height="24" /></th>
  </tr>
 
   <tbody>
      <?php
         while ($row = mysql_fetch_assoc($rs))
         {
  echo "<tr style=\"cursor:hand\" onMouseOver=\"this.style.background='#E1E1E1'; this.style.color='blue'\" onMouseOut=\"this.style.background='#FFFFFF'; this.style.color='black'\" >";
    echo "<td class=\"col\">". $row['id']. "</td>";
	echo "<td class=\"col\">". $row['codigo']. "</td>";
    echo "<td class=\"col\">". $row['categoria'] ."</td>";
    echo "<td class=\"col\">". $row['producto'] ."</td>";
    echo "<td class=\"col\">". $row['descripcion'] ."</td>";
    echo "<td class=\"col\">". $row['imagen'] ."</td>";
    echo "<td class=\"col\">". $row['precio'] ."</td>";
    echo "<td class=\"col\">". $row['fecha'] ."</td>";
    echo "<td class=\"col red-bg\"><a href='borrar_viaje.php?vi_id=" . $row["id"]." '>Borrar</a></td>";
    echo "<td class=\"col orange-bg\"><a href='editar_viaje.php?vi_id=" . $row["id"]." '>Editar</a></td>";
  echo "</tr>";
         }
      ?>
   </tbody>
   <tfoot>
      <tr>
         <td colspan="2">
      <?php
         $totalPag = ceil($total/$limit);
         $links = array();
         for( $i=1; $i<=$totalPag ; $i++)
         {
            $links[] = "<a href=\"?pag=$i\">$i</a>"; 
         }
         echo implode(" - ", $links);
      ?>
         </td>
      </tr>
   </tfoot>
</table>