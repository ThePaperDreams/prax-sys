<?php
$this->migas = [
	'Home' => ['principal/inicio'],
	'Reportes' => ['reportes/todos'],
	'Pagos Pendientes',
];

$this->opciones = [
	'elementos' => [
		'Todos los reportes' => ['reportes/todos'],
	],
];

$this->tituloPagina = "Pagos pendientes";

 ?>

<div class="tile p-15">
	<div class="row">
		<div class="col-sm-12">
			
			<div class="page-header">
				<h5><i class="fa fa-filter"></i> Filtros </h5>
			</div>
			<form method="POST">
				<!-- Filtros -->
				<!-- Fin filtros -->
			</form>
		</div>
	</div>
</div>

<table class="table table-table-bordered">
	<thead>
		<tr>
			<th>Titulo 1</th>
			<th>Titulo 2</th>
			<th>Titulo 3</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Contenido 1</td>
			<td>Contenido 2</td>
			<td>Contenido 3</td>
		</tr>
	</tbody>
</table>