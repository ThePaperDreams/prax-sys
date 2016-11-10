<?php if (count($objetivos) == 0): ?>
	<h4 class="text-center">No hay objetivos</h4>
<?php else: ?>
<p>
	<strong>Total objetivos: </strong> <?= count($objetivos) ?>
</p>
<table>
	<thead>
		<tr>
			<th>Objetivo</th>
			<th>Descripción</th>			
		</tr>
	</thead>
	<tbody>
		<?php foreach ($objetivos as $objetivo): ?>			
		<tr>
			<td><?= $objetivo->titulo ?></td>
			<td><?= $objetivo->descripcion ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<p>
	<strong>Total objetivos: </strong> <?= count($objetivos) ?>
</p>
<?php endif ?>