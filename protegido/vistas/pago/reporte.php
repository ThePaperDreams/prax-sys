<?php if (count($pagos) == 0): ?>
	<h4 class="text-center">No hay pagos</h4>
<?php else: ?>
<p>
	<strong>Total pagos: </strong> <?= count($pagos) ?>
</p>
<table>
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Valor cancelado</th>			
			<th>Descuento</th>			
			<th>Deportista</th>			
			<th>Categoría</th>
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($pagos as $pago): ?>			
		<tr>
			<td><?= $pago->fecha ?></td>
			<td><?= $pago->valor_cancelado ?></td>
			<td><?= $pago->descuento ?></td>
			<td><?= $pago->MatriculaPago->Deportista->nombreCompleto ?></td>
			<td><?= $pago->categoria ?></td>
			<td><?= $pago->etiquetaEstado ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<p>
	<strong>Total pagos: </strong> <?= count($pagos) ?>
</p>
<?php endif ?>