<table>
	<thead>
		<tr>
			<th>Deportista</th>
			<th>Categoría</th>
			<th>Desde</th>
			<th>Hasta</th>
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
	<?php if (count($pagos) == 0): ?>
		<tr>
			<td colspan="6" class="text-center">
				No hay registros
			</td>
		</tr>
	<?php else: ?>
	<?php foreach ($pagos as $pago): ?>			
		<tr>
			<td><?= $pago->MatriculaPago->Deportista->nombreIdentificacion ?></td>
			<td><?= $pago->categoria ?></td>
			<td><?= $pago->fecha_inicio ?></td>
			<td><?= $pago->fecha_fin ?></td>
			<td><?= $pago->EtiquetaEstado ?></td>
		</tr>
		<?php endforeach ?>
	<?php endif ?>

	</tbody>
</table>
<?php if (count($pagos) > 0): ?>
<p>
	<strong>Total Pagos realizados: </strong> <?= count($pagos) > 0? count($pagos) : '' ?>
</p>
<?php endif ?>
