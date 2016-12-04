<table>
	<thead>
		<tr>
			<th>Documento</th>
			<th>Nombre</th>
			<th>Acudientes</th>
		</tr>
	</thead>
	<tbody>
	<?php if (count($deportistas) == 0): ?>
		<tr>
			<td colspan="6" class="text-center">
				No hay registros
			</td>
		</tr>
	<?php else: ?>
	<?php foreach ($deportistas as $deportista): ?>			
		<tr>
			<td><?= $deportista->identificacion ?></td>
			<td><?= $deportista->nombreCompleto ?></td>
			<td><?= $deportista->acudientesString ?></td>
		</tr>
		<?php endforeach ?>
	<?php endif ?>

	</tbody>
</table>
<?php if (count($deportistas) > 0): ?>
<p>
	<strong>Total deportistas: </strong> <?= count($deportistas) > 0? count($deportistas) : '' ?>
</p>
<?php endif ?>
