<?php

    $dia_num = date("w");
    $num_dia = date("j");
    $mes_num = date("m");
    $anio = date("Y");
   
    $dia = array( 0 => "DOMINGO", 1 => "LUNES", 2 => "MARTES", 3 => "MIERCOLES", 4 => "JUEVES", 5 => "VIERNES", 6 => "SABADO");
    $mes = array( "01" => "ENERO","02" => "FEBRERO","03" => "MARZO","04" => "ABRIL","05" => "MAYO", "06" => "JUNIO", "07" => "JULIO", "08" => "AGOSTO", "09" => "SEPTIEMBRE", "10" => "OCTUBRE", "11" => "NOVIEMBRE", "12" => "DICIEMBRE");
   
    $day= $dia[$dia_num];
    $mont=$mes[$mes_num];
   
    echo "<b>".$day." ".$num_dia." DE ".$mont."</b> | <b>".$anio."</b>&nbsp;&nbsp;"; 


?>