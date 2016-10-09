<?php 

/**
 * Esta función hace una previsualización del contenido de una o varias variables
 * usando la función var_dump, pero se asegura de incluir las etiquetas pre para 
 * asegurar una correcta visualización del contenido de cada variable.
 */
function pre(){
	$parametros = func_get_args();
	echo '<pre>';
	foreach ($parametros as $p) {
		var_dump($p);
	}
	echo '</pre>';
}