<?php 

class CLogs extends CComponenteAplicacion{
	private $rutaLogs;

	public function __construct(){
		$this->rutaLogs = Sis::resolverRuta("!aplicacion.logs");
	}

	public function escribir($tipo = "Error", $texto = "", $hora = true){
		$nombreLog = date("Y-m-d") . ".txt";
		$linea = "[$tipo] " . ($hora? "[" . date("H:i:s") . "]\t" : "") . $texto;
		$handle = fopen($this->rutaLogs . DS . $nombreLog, "a");
		fwrite($handle, $linea . "\r\n");
		return fclose($handle);
	}
}