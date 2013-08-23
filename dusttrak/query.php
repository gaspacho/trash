<?php
$grid_id = $_REQUEST["equipo"];
$desde = $_REQUEST["datePickerDesde"];
$hasta = $_REQUEST["datePickerHasta"];

if(!isset($desde) || !isset($hasta)){
	header('Location: error.php');    
}
else{
	header("Location: equipos.php?equipo=$grid_id&datePickerDesde=$desde&datePickerHasta=$hasta"); 
}

require_once("includes/footer.php");
?>
