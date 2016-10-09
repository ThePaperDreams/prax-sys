<table>
	<thead>
		<tr>
			<th>Deportista</th>
			<th>Estado</th>
			<th>Año</th>
			<th>Categoría</th>
			<th>Fecha de pago</th>
			<th>Fecha realización</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($matriculas as $matricula): ?>			
		<tr>
			<td><?= $matricula->Deportista->NombreIdentificacion ?></td>
			<td style="color:<?= $matricula->estado == 1? 'green' : 'red'; ?>"><?= $matricula->EtiquetaEstado ?></td>
			<td><?= $matricula->anio ?></td>
			<td><?= $matricula->Categoria->nombre ?></td>
			<td><?= $matricula->fecha_pago ?></td>
			<td><?= $matricula->fecha_realizacion ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>