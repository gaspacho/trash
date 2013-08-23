<form name="formquery" action='query.php' method=post onsubmit="return validateFormOnSubmit(this)">

<select name="equipo">
	<option <?php if (!isset($_REQUEST["equipo"])) { echo "selected";} ?> value="0"> -- </option>
	<option <?php if (isset($_REQUEST["equipo"])) { if ($_REQUEST["equipo"] == "1") {echo "selected";}} ?> value="1"> DustTrak 1 </option>
	<option <?php if (isset($_REQUEST["equipo"])) { if ($_REQUEST["equipo"] == "2") {echo "selected";}} ?> value="2"> DustTrak 2 </option>
</select>

Fecha desde: <input type ='text' id="dateFieldDesde" name="datePickerDesde" size="8" readonly="readonly" onfocus="showCal('calDesde', document.formquery.datePickerDesde)" > <img src="img/calendar-icon.png" alt="Calendar" title="Calendar" onclick="toggleCal('calDesde')" style="cursor: pointer; vertical-align: bottom" /> <div id="calDesde" style="display: none; position: absolute; border: 2px solid #555"></div> 

Fecha hasta: <input type ='text' id="dateFieldHasta" name="datePickerHasta" size="8" readonly="readonly" onfocus="showCal('calHasta', document.formquery.datePickerHasta)" > <img src="img/calendar-icon.png" alt="Calendar" title="Calendar" onclick="toggleCal('calHasta')" style="cursor: pointer; vertical-align: bottom" /> <div id="calHasta" style="display: none; position: absolute; border: 2px solid #555"></div> 
<input type='submit' value='Consultar'>
</form>
<a href="http://siafa.com.ar/ccys/instructivo_web.pdf">Instructivo Web</a>&nbsp; &nbsp;
<a href="http://siafa.com.ar/ccys/instructivo_excel.pdf">Instructivo Excel</a>&nbsp; &nbsp;
