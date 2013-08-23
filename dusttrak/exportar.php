<?php
include_once("includes/parameters.php");
require_once("includes/dbConnect.php");



class Export2ExcelClass{ 
    var $FileName   = "export"; #Nombre del archivo 
    var $xls        = "";       #Contenido del archivo 
    var $row        = 1;        #Fila 
    var $col        = 1;        #Columna 

    public function Export2ExcelClass($file_name = "export"){ 
        //Inicio de clase 
        $this->FileName = $file_name; 
    } 

    private function Head($file_name = ""){ 
        //Escribe cabeceras 
        $this->FileName = ($file_name == "") ? $this->FileName : $file_name; 
        $f = $this->FileName; 
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT"); 
        header("Cache-Control: no-cache, must-revalidate"); 
        header("Pragma: no-cache"); 
        header("Content-type: application/x-msexcel"); 
        header("Content-Disposition: attachment; filename=$f.xls" ); 
        header("Content-Description: PHP/INTERBASE Generated Data" ); 
        header("Expires: 0"); 
    } 

    private function BOF(){ 
        //Inicio de archivo 
        return pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0); 
    } 

    private function EOF(){ 
        //Fin de archivo 
        return pack("ss", 0x0A, 0x00); 
    } 

    public function Number($Row, $Col, $Value){ 
        //Escribe un n�mero (double) en la $Row/$Col 
        $this->xls .= pack("sssss", 0x203, 14, $Row, $Col, 0x0); 
        $this->xls .= pack("d", $Value); 
    } 

    public function Text($Row, $Col, $Value){ 
        //Escribe texto en $Row/$Col (UTF8) 
        $Value2UTF8 = utf8_decode($Value); 
        $L = strlen($Value2UTF8); 
        $this->xls .= pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
        $this->xls .= $Value2UTF8; 
    } 

    public function Write($Row, $Col, $Value){ 
        //Escribir texto o numeros en $Row/$Col 
        if (is_numeric($Value)) $this->Number($Row, $Col, $Value); 
        else $this->Text($Row, $Col, $Value); 
    } 

    public function WriteMatriz($Matriz){ 
        //Convierte una matriz en una planilla 
        //NOTA: Elimina el contenido que haya hasta ahora almacenado! 
        /* 
         * Ejemplo: 
         * $Matriz = array( 
         *      array('Nombre', 'Apellido', 'Edad'), 
         *      array('Luciana', 'Camila', 1), 
         *      array('Eduardo, 'Cuomo', 24), 
         *      array('Vanesa', 'Chavez', 21) 
         * ); 
         * 
         * Devuelve un EXCEL como: 
         * _| A     | B      | C  | 
         * 1|Nombre |Apellido|Edad| 
         * 2|Luciana|Camila  |1   | 
         * 3|Eduardo|Cuomo   |24  | 
         * 4|Vanesa |Chavez  |21  | 
         * 
        */ 
        $this->xls = ""; 
        $nRow = 0; 
        $nCol = 0; 
        foreach($Matriz as $Row){ 
            foreach($Row as $Value){ 
                $this->Write($nRow, $nCol, $Value); 
                $nCol++; 
            } 
            $nCol = 0; 
            $nRow++; 
        } 
    } 

    public function Download($file_name = ""){ 
        //Escribe el archivo y agrega las cabeceras para generar la descarga 
        $this->Head($file_name); 
        echo $this->BOF(); 
        echo $this->xls; 
        echo $this->EOF(); 
    } 

    public function Archivo($loc_file){ 
        //Crea archivo, borrando el que existe si ya existia 
        //$loc_file : Ruta del archivo. Ej: "./downloads/archivo.xls" 
        $f = fopen($loc_file, 'w'); 
        fwrite($f, $this->BOF()); 
        fwrite($f, $this->xls); 
        fwrite($f, $this->EOF()); 
        fclose($f); 
    } 


}

$equipo = $_REQUEST["equipo"];
$desde = $_REQUEST["datePickerDesde"];
$hasta = $_REQUEST["datePickerHasta"];

//Antes de esto, debe estar la clase anterior! 
//Generamos el objeto 
$excel = new Export2ExcelClass; 
//Matriz a convertir:
$matriz = array(array("Concentracion de particulas del equipo $equipo", ''), array('Fecha y hora', 'Concentracion [mg/m3]'));
if (isset($desde) && isset($hasta))
{
//	$sql = "SELECT * FROM historical WHERE (register_type = 11) AND (address = 1) AND (value >= 4000) AND (grd_id = $equipo) AND timestamp BETWEEN '$desde 00:00:00' AND '$hasta 23:59:59'";
$sql = "SELECT * FROM historical WHERE (register_type = 11) AND (value >= 4000) AND (grd_id = $equipo) AND timestamp BETWEEN '$desde 00:00:00' AND '$hasta 23:59:59'";

	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result)){
		$ts = $row["timestamp"];
		$valor = $row["value"];
		$concentracion = number_format(($valor - 4000) * 0.0003 ,3);
		$matriz[] = array($ts, $concentracion);
	}
	//Convertimos la matriz a Excel: 
	$excel->WriteMatriz($matriz); 
	//Hacemos que sea descargable: 
$fechaac = strftime('%c');

	$excel->Download("DustTrak $fechaac");
}
?>
