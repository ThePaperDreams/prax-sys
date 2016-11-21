
<table>
	<thead>
		<tr>
			<th>Categoría</th>
			<th>Nombre</th>
			<th>Estado</th>
			<th>Min. Unidades</th>
			<th>Unid. Disponibles</th>
		</tr>
	</thead>
	<tbody>
	<?php if (count($implementos) > 0): ?>		
		<?php foreach ($implementos as $implemento): ?>			
		<tr>
			<td><?= $implemento->Categoria->nombre ?></td>
			<td><?= $implemento->nombre ?></td>
			<td><?= $implemento->EtiquetaEstado ?></td>
			<td><?= $implemento->minimo_unidades ?></td>
			<td><?= $implemento->unidades ?></td>
		</tr>
		<?php endforeach ?>
	<?php else: ?>
		<tr>
			<td colspan="5" class="text-center">No hay registros.</td>
		</tr>
	<?php endif ?>
	</tbody>
</table>
<?php if (count($implementos) > 0): ?>
	
<p>
	<strong>Total implementos: </strong> <?= count($implementos) ?>
</p>
<?php endif ?>