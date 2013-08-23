<a href="http://siafa.com.ar/ccys"><img src="img/header.png"></a>


<div id="form1">
		<?php	include("formquery.php");
				if (isset($_REQUEST["datePickerDesde"]) && isset($_REQUEST["datePickerHasta"]) && isset($_REQUEST["equipo"])) {
					$equipo = $_REQUEST["equipo"];
					$desde = $_REQUEST["datePickerDesde"];
					$hasta = $_REQUEST["datePickerHasta"];
					echo "<a href=\"exportar.php?equipo=$equipo&datePickerDesde=$desde&datePickerHasta=$hasta\">Exportar</a>";
				}
		?>
</div>




<div id="cuerpo">
<div id="left">

<div id="siafa">
<img src="img/ima.png">
<p>Diseño, provisíon, instalación, entrenamiento, mantenimiento, calibración y reparacion de sistemas e instrumental dedicado al resguardo de la higiene laboral y el cuidado del medio 
ambiente.</p>



<p>Av. J. B. Alberdi 5283 - Ciudad Autónoma de Buenos Aires</p>
<p>Tel: 011 4684-2232 </p>
<p>Fax: 011 4684 1141</p>

<p><a href="http://siafa.com.ar/">www.siafa.com.ar</a></p>


<p><a href="mailto:serviciotecnico@siafa.com.ar">serviciotecnico@siafa.com.ar</a></p>

</div>
</div>





<div id="right">

                <?php
                        if (isset($_REQUEST["datePickerDesde"]) && isset($_REQUEST["datePickerHasta"]) && isset($_REQUEST["equipo"])) {
                                $equipo = $_REQUEST["equipo"];
                                $desde = $_REQUEST["datePickerDesde"];
                                $hasta = $_REQUEST["datePickerHasta"];
                                include("tabla.php");
                        }
			else {
				echo "   <h3>SELECCIÓN DE EQUIPO Y RANGO DE FECHAS</h3>
<p>Uno de los beneficios importantes de nuestro sistema de visualización es la posibilidad de filtrar los
datos por equipo.
De igual manera, también se pueden filtras los datos por rango de fecha.
Para desplegar el menú calendario y poder seleccionar la fecha inicial, sólo basta con ubicar el cursor
dentro del campo en blanco “Fecha desde:”. De igual manera se procede con la fecha final.
Por último, sólo es necesario hacer clic sobre el botón consultar.</p>";
			}

                ?>



</div>

</div>
<div id="pie">
<img src="img/pie.png">
</p>


