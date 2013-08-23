function validateFormOnSubmit(form) {
	if (!validateEquipment(form.equipo)) {
		alert("Debe seleccionar un equipo");
		return false;
	}
	if (!validateDate(form.datePickerDesde)) {
		form.desde.style.background = 'Red';
		alert("La fecha debe tener formato 'AAAA-MM-DD'");
		return false;
	}
	if (!validateDate(form.datePickerHasta)) {
		form.hasta.style.background = 'Red';
		alert("La fecha debe tener formato 'AAAA-MM-DD'");
		return false;
	}
	return true;
}

function validateEquipment(field) {
	if (field.value == "0") {
		return false;
	}
	return true;
}

function validateDate(field) {
	var re = new RegExp("[0-9]{4}-[0-9]{2}-[0-9]{2}");
	return field.value.match(re);
}

function exportToExcel()
{
	alert("inicio script");
	str="";

	var mytable = document.getElementsByTagName("table")[0];
	var row_Count = mytable.rows.length;
	var col_Count = mytable.getElementsByTagName("tr")[0].getElementsByTagName("td").length;    

	if (window.ActiveXObject) {
	alert("creo variables excel");
	var ExcelApp = new ActiveXObject("Excel.Application");
	alert("creo hoja excel");
	var ExcelSheet = new ActiveXObject("Excel.Sheet");
	ExcelSheet.Application.Visible = true;

	alert("inicio el loop");
	for(var i=0; i < row_count ; i++) 
	{   
		for(var j=0; j < col_Count; j++) 
		{           
			str= mytable.getElementsByTagName("tr")[i].getElementsByTagName("td")[j].innerHTML;
			ExcelSheet.ActiveSheet.Cells(i+1,j+1).Value = str;
		}
	}
	}
	else {
	alert("el browser no soporta active x");
	}
}
