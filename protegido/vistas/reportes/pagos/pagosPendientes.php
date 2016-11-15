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

			<?php if ($fechaIni == null && $fechaFin == null): ?>
			<div class="alert alert-warning">
				Por favor ingrese una fecha inicial o una final
			</div>
			<?php endif ?>

			<div class="page-header">
				<h5><i class="fa fa-filter"></i> Filtros </h5>
			</div>

			<form method="POST" class="">
				<!-- Filtros -->
				<div class="form-group col-sm-3">
					<label for="fecha-final">Deportista</label>
					<?= CBoot::select('', $deportistas, ['data-s2' => true, 'defecto' => 'Busque por deportista']) ?>
				</div>

				<div class="form-group col-sm-3">
					<label for="fecha-inicial">Fecha Inicial</label>
					<div class="input-group">
						<input id="fecha-inicial" type="text" class="form-control">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
					</div>
				</div>

				<div class="form-group col-sm-3">
					<label for="fecha-final">Fecha Final</label>
					<div class="input-group">
						<input id="fecha-final" type="text" class="form-control">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
					</div>
				</div>

				<div class="form-group col-sm-3">
					<label for="">&nbsp;&nbsp;&nbsp;</label><br>
					<button class="btn btn-default">
						<i class="fa fa-filter"></i> Filtrar 
					</button>
				</div>
				<!-- Fin filtros -->
			</form>
		</div>
	</div>
</div>

<table class="table table-table-bordered">
	<thead>
		<tr>
			<th>Deportista</th>
			<th>MesesPendientes</th>
		</tr>
	</thead>

	<tbody>
	<?php foreach ($pagosPendientes AS $pago): ?>
		<tr>
			<td>Contenido 1</td>
			<td>Contenido 2</td>
		</tr>		
	<?php endforeach ?>
	</tbody>
</table>