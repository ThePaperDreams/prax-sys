<?php if (count($entradas) == 0): ?>
	<h4 class="text-center">No hay entradas</h4>
<?php else: ?>
<p>
	<strong>Total entradas: </strong> <?= count($entradas) ?>
</p>
<table>
	<thead>
		<tr>
			<th>Fecha de realización</th>
			<th>Descripción</th>			
			<th>Responsable</th>			
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($entradas as $entrada): ?>			
		<tr>
			<td><?= $entrada->fecha_realizacion ?></td>
			<td><?= $entrada->Descripcion ?></td>
			<td><?= $entrada->Usuario->nombres ?></td>
			<td><?= $entrada->EtiquetaEstado ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<p>
	<strong>Total entradas: </strong> <?= count($entradas) ?>
</p>
<?php endif ?>