<?php  //equipos

if (isset($desde) && isset($hasta) && isset($equipo))
{
	$filas_por_pagina = 25;
	$paginas_mostradas = 3;
	$sql = "SELECT * FROM historical WHERE (register_type = 11) AND (value >= 4000) AND (grd_id = $equipo) AND timestamp BETWEEN '$desde 00:00:00' AND '$hasta 23:59:59'  ORDER BY 
timestamp DESC";
	$result = mysql_query($sql) or die("Error en el query".mysql_error());
	$cantidad_filas = mysql_num_rows($result) or die("Error en la consulta de cantidad de filas".mysql_error());
	if ($cantidad_filas == 0) {
		echo "<font face=\"verdana\" size=3>No hay resultados para mostrar entre el $desde y el $hasta </font><br>";
	} else {
		$pagina = $_REQUEST["pagina"];
		if (!isset($pagina)) {
			$pagina = 1;
		}
		$paginas = ceil($cantidad_filas / $filas_por_pagina);
		$comienzo_filas = $filas_por_pagina * ($pagina - 1);
		$sql = "SELECT * FROM historical WHERE (register_type = 11) AND (value >= 4000) AND (grd_id = $equipo) AND timestamp BETWEEN '$desde 00:00:00' AND '$hasta 23:59:59' 
ORDER BY timestamp DESC LIMIT $comienzo_filas, $filas_por_pagina ";
		$result = mysql_query($sql);



		if ($paginas > 2 * $paginas_mostradas) {
			if ($pagina > 1) {
				echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=1\"> &laquo; </a>";
				$pagina_anterior = $pagina - 1;
				echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$pagina_anterior\"> < </a>";
			}
			if ($pagina <= ($paginas_mostradas + 1)) {
				for ($i = 1; $i <= ($paginas_mostradas * 2); $i++) {
					if ($i == $pagina) {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\" class=\"actual\"> $i </a>";
					} else {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\"> $i </a>";
					}
				}
				echo "...";
			} else if ($pagina >= ($paginas - $paginas_mostradas)) {
				echo "...";
				for ($i = ($paginas - 2 * $paginas_mostradas); $i <= $paginas; $i++) {
					if ($i == $pagina) {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\" class=\"actual\"> $i </a>";
					} else {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\"> $i </a>";
					}
				}
			} else {
				echo "...";
				for ($i = ($pagina - $paginas_mostradas); $i <= ($pagina + $paginas_mostradas); $i++) {
					if ($i == $pagina) {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\" class=\"actual\"> $i </a>";
					} else {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\"> $i </a>";
					}
				}
				echo "...";
			}
			if ($pagina < $paginas) {
				$pagina_siguiente = $pagina + 1;
				echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$pagina_siguiente\"> > </a>";
				echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$paginas\"> &raquo; </a>";
			}
		}
		else {
			for ($i = 1; $i <= $paginas; $i++) {
				if ($i == $pagina) {
					echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\" class=\"actual\"> $i </a>";
				} else {
					echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\"> $i </a>";
				}
			}
		}

echo "&nbsp; &nbsp; &nbsp; <a href=\"#abajo\"><span id=\"arriba\">Ir abajo</span></a>";
echo "<h4>Resultados desde $desde al $hasta</h4>";



		echo " <font face=\"verdana\" size=5>Concentraci&oacute;n de part&iacute;culas del equipo $equipo</font><br>
		<table id=\"hor-minimalist-b\">
		<thead>
			<tr>
				<th> Fecha y hora </th>
				<th> Concentraci&oacute;n [mg/m3] </th>
			</tr>
		</thead>
		<tbody>";
		while ($row = mysql_fetch_array($result)){
			$ts = $row["timestamp"];
			$tiempo = preg_replace("/([0-9]+)-([0-9]+)-([0-9]+)(.*)/", "$3-$2-$1$4", $ts);
			$valor = $row["value"];
			$concentracion = number_format(($valor - 4000) * 0.0003 ,3);

			echo "
			<tr>
				<td> $tiempo </td>
				<td> $concentracion </td>
			</tr>";
		}
		echo "</tbody> </table>";

		if ($paginas > 2 * $paginas_mostradas) {
			if ($pagina > 1) {
				echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=1\"> &laquo; </a>";
				$pagina_anterior = $pagina - 1;
				echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$pagina_anterior\"> < </a>";
			}
			if ($pagina <= ($paginas_mostradas + 1)) {
				for ($i = 1; $i <= ($paginas_mostradas * 2); $i++) {
					if ($i == $pagina) {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\" class=\"actual\"> $i </a>";
					} else {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\"> $i </a>";
					}
				}
				echo "...";
			} else if ($pagina >= ($paginas - $paginas_mostradas)) {
				echo "...";
				for ($i = ($paginas - 2 * $paginas_mostradas); $i <= $paginas; $i++) {
					if ($i == $pagina) {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\" class=\"actual\"> $i </a>";
					} else {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\"> $i </a>";
					}
				}
			} else {
				echo "...";
				for ($i = ($pagina - $paginas_mostradas); $i <= ($pagina + $paginas_mostradas); $i++) {
					if ($i == $pagina) {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\" class=\"actual\"> $i </a>";
					} else {
						echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\"> $i </a>";
					}
				}
				echo "...";
			}
			if ($pagina < $paginas) {
				$pagina_siguiente = $pagina + 1;
				echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$pagina_siguiente\"> > </a>";
				echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$paginas\"> &raquo; </a>";
			}
		}
		else {
			for ($i = 1; $i <= $paginas; $i++) {
				if ($i == $pagina) {
					echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\" class=\"actual\"> $i </a>";
				} else {
					echo "<a href=\"equipos.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta&pagina=$i\"> $i </a>";
				}
			}
		}
echo "&nbsp; &nbsp; &nbsp;  <a href=\"#arriba\"><span id=\"abajo\">Ir arriba</span></a>";

	}
}
?>
