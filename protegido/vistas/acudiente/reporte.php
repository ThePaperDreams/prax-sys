<table>
	<thead>
		<tr>
			<th>Documento</th>
			<th>Nombre</th>
			<th>Teléfono 1</th>
			<th>Teléfono 2</th>
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php if (count($acudientes) > 0): ?>
			<?php foreach ($acudientes as $acudiente): ?>			
		<tr>
			<td><?= $acudiente->identificacion ?></td>
			<td><?= $acudiente->nombreCompleto ?></td>
			<td><?= $acudiente->telefono1 ?></td>
			<td><?= $acudiente->telefono2 ?></td>
			<td><?= $acudiente->EtiquetaEstado ?></td>
		</tr>
			<?php endforeach ?>
		<?php else: ?>
			<tr>
				<td colspan="5" class="text-center">No hay registros</td>
			</tr>
		<?php endif ?>
	</tbody>
</table>
<?php if (count($acudientes) > 0): ?>
<p>
	<strong>Total acudientes: </strong> <?= count($acudientes) ?>
</p>
<?php endif ?>