<div class="row">
	<div class="col-6">
		<table class="table-simple">
			<tr>
				<th class="text-left">
					<strong>Fecha aplicación:</strong>
				</th>
				<td>
					<?= $plan->fecha_aplicacion ?>
				</td>
			</tr>
			<tr>
				<th class="text-left">
					<strong>Categoría:</strong>
				</th>
				<td>
					<?= $plan->Categoria->nombre ?>
				</td>
			</tr>
			<tr>
				<th class="text-left">
					<strong>Descripción:</strong>
				</th>
				<td>
					<?= $plan->descripcion ?>
				</td>
			</tr>				
		</table>
	</div>
	<div class="col-4">
	</div>
</div>
<h3>Objetivos del plan</h3>

<?php if (count($plan->Detalles) == 0): ?>
	<p>No hay objetivos asosciados al plan</p>
<?php else: ?>
<table class="table-simple table-row">
	<thead>
		<tr>
			<th>Título</th>
			<th>Descripción</th>
		</tr>
	</thead>	
	<?php foreach ($plan->Detalles as $detalle): ?>
	<tr>
		<td class="col-3"><strong><?= $detalle->Objetivo->titulo ?></strong></td>
		<td class="col-7"><?= $detalle->Objetivo->descripcion ?></td>
	</tr>
	<?php endforeach ?>
</table>
<?php endif ?>