<?php 
$this->tituloPagina = "Registrar seguimiento a "  . CHtml::e("strong", $deportista->nombreCompleto);
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar deportistas' => ['Deportista/inicio'],
    'Ficha técnica ' . $deportista->nombreCompleto => ['Deportista/fichaTecnica', 'id' => $deportista->id],
    'Añadir seguimientos',
];
?>

<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-6">
			<a target="_blank" href="<?= Sis::crearUrl(['deportista/imprimirSeguimientos', 'id' => $deportista->id]) ?>">
				<button class="btn btn-primary btn-block">
					Imprimir <i class="fa fa-print"></i>
				</button>
			</a>
			<div class="p-10"></div>
		</div>
	</div>
	<div class="row">		
		<div class="col-sm-6">
			<div class="tile p-15">
				<h4>Aspectos positivos</h4>
				<hr>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Entrenador</th>
							<th>Descripción</th>
							<th>Pts.</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>						
					<?php foreach ($positivos as $seg): ?>
						<tr>
							<td><?= $seg->Entrenador->nombreCompleto ?></td>
							<td><?= $seg->descripcion ?></td>
							<td><?= $seg->evaluacion ?></td>
							<td><?= $seg->fecha ?></td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="tile p-15">
				<h4>Aspectos a mejorar</h4>
				<hr>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Entrenador</th>
							<th>Descripción</th>
							<th>Pts.</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>						
					<?php foreach ($negativos as $seg): ?>
						<tr>
							<td><?= $seg->Entrenador->nombreCompleto ?></td>
							<td><?= $seg->descripcion ?></td>
							<td><?= $seg->evaluacion ?></td>
							<td><?= $seg->fecha ?></td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>