<table>
	<thead>
		<tr>
			<th>Deportista</th>
			<th>Club de Origen</th>
			<th>Club Destino</th>
			<th>Fecha Fnicio</th>
			<th>Fecha Fin</th>
			<th>Estado</th>
			<th>Tipo de préstamo</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($prestamos as $prestamo): ?>			
		<tr>
			<td><?= $prestamo->Deportista->NombreIdentificacion ?></td>
			<td><?= $prestamo->club_origen ?></td>
			<td><?= $prestamo->club_destino ?></td>
			<td><?= $prestamo->fecha_inicio ?></td>
			<td><?= $prestamo->fecha_fin ?></td>
			<td style="color:<?= $prestamo->estado == 1? 'green' : 'red'; ?>"><?= $prestamo->EtiquetaEstado ?></td>
			<td><?= $prestamo->tipo_prestamo ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>