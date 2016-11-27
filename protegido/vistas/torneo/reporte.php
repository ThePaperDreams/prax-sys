<table>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Mínimo equipos</th>
			<th>Edad máxima</th>
			<th>Fecha inicio</th>
			<th>Fecha fin</th>
		</tr>
	</thead>
	<tbody>
	<?php if (count($torneos) > 0): ?>		
		<?php foreach ($torneos as $torneo): ?>			
		<tr>
			<td><?= $torneo->nombre ?></td>
			<td><?= $torneo->cupo_minimo ?></td>
			<td><?= $torneo->edad_maxima ?></td>
			<td><?= $torneo->fecha_inicio ?></td>
			<td><?= $torneo->fecha_fin ?></td>
		</tr>
		<?php endforeach ?>
	<?php else: ?>
		<tr>
			<td colspan="5" class="text-center">No hay registros.</td>
		</tr>
	<?php endif ?>
	</tbody>
</table>
<?php if (count($torneos) > 0): ?>
	
<p>
	<strong>Total torneos: </strong> <?= count($torneos) ?>
</p>
<?php endif ?>