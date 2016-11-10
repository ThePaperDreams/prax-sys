<?php if (count($salidas) == 0): ?>
	<h4 class="text-center">No hay salidas</h4>
<?php else: ?>
<p>
	<strong>Total salidas: </strong> <?= count($salidas) ?>
</p>
<table>
	<thead>
		<tr>
			<th>Fecha de realización</th>
			<th>Fecha de entrega</th>
			<th>Descripción</th>			
			<th>Responsable</th>			
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($salidas as $salida): ?>			
		<tr>
			<td><?= $salida->fecha_realizacion ?></td>
			<td><?= $salida->fecha_entrega ?></td>
			<td><?= $salida->Descripcion ?></td>
			<td><?= $salida->Usuario->nombres ?></td>
			<td><?= $salida->EtiquetaEstado ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<p>
	<strong>Total salidas: </strong> <?= count($salidas) ?>
</p>
<?php endif ?>