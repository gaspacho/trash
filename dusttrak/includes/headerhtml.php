<head>
	<title><?php echo $siteTitle ?></title>
	<meta charset="UTF-8" />
	<link rel="STYLESHEET" type="text/css" href="estilos/estilos.css">
	<link rel="STYLESHEET" type="text/css" href="estilos/RGF_DatePicker.css">
	<script language="JavaScript" src="scripts/validation.js"></script>
	<script language="JavaScript" src="scripts/RGF_DatePicker.js"></script>
	<script type="text/javascript">
	function drawCal() {
	    rgf_buildCalendar(new Date(), 'calHasta', document.formquery.datePickerHasta, true);
	}

	function showCal(id, field) {
	    rgf_buildCalendar(new Date(), id, field, true);
	    var calId = document.getElementById(id);
	    calId.style.display = 'block';
	}

	function toggleCal(id) {
	    var calId = document.getElementById(id);
	    calId.style.display = (calId.style.display == 'none') ? 'block' : 'none';
	}
	</script>
</head>
<body>

<div id="contenedor">
