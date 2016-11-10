<?php if (count($categorias) > 0): ?>
	<p>
		<strong>Total categorías: </strong> <?= count($categorias) ?>
	</p>
<?php endif ?>
<table>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Matriculados</th>
			<th>Max - Min</th>
			<th>Tarifa</th>
			<th>Edades</th>
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
	<?php if (count($categorias) > 0): ?>
		
		<?php foreach ($categorias as $categoria): ?>
		<tr>
			<td><?= $categoria->nombre ?></td>
			<td><?= $categoria->matriculados ?></td>
			<td><?= $categoria->cuposDisponibles ?></td>
			<td><?= $categoria->tarifa ?></td>
			<td><?= $categoria->edad ?></td>
			<td><?= $categoria->EtiquetaEstado ?></td>
		</tr>
		<?php endforeach ?>
	<?php else: ?>
		<tr>
			<td colspan="6" class="text-center">No hay registros</td>
		</tr>
	<?php endif ?>
	</tbody>
</table>
<?php if (count($categorias) > 0): ?>
	<p>
		<strong>Total categorías: </strong> <?= count($categorias) ?>
	</p>
<?php endif ?>