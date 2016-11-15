<?php 
$this->tituloPagina = "Suscriptores";
 ?>
<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
	'ajax' => true,
	'fnCriterios' => 'filtrosAjxSuscriptor',
	'filtrosAjax' => [
		'nombre_usuario', 'nombres', 'apellidos', 'email',
		'estado' => CBoot::select('', [1 => 'Activo', 0 => 'Inactivo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado']),
	],
	'modelo' => 'Usuario',
	'criterios' => $criterios,
	'columnas' => [
		'nombre_usuario',
		'nombres',
		'apellidos',
		'email',
		'estado' => 'EtiquetaEstado',
	],
	'opciones' => [
		['i' => 'eye', 'url' => 'Usuario/verSuscriptor&{id:pk}', 'title' => 'Ver'],
		// ['i' => 'remove', 'url' => 'Usuario/banearSuscriptor&{id:pk}', 'title' => 'Bloquear'],
	],
	'paginacion' => 10
]) ?>