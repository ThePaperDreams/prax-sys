<table>
	<tr>
		<th class="text-left col-3">Nombre completo</th>
		<td><?= $deportista->nombreCompleto ?></td>
	</tr>
	<tr>
		<th class="text-left col-3">Edad</th>
		<td><?= $deportista->edad ?></td>
	</tr>
	<tr>
		<th class="text-left col-3">Fecha de nacimiento</th>
		<td><?= $deportista->fecha_nacimiento ?></td>
	</tr>
	<tr>
		<th class="text-left col-3">Categoría</th>
		<td><?= $deportista->nombreCategoria ?></td>
	</tr>
</table>
<div class="col-sm-12">
	<div class="row">		
		<div class="col-5">
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
		<div class="col-5">
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