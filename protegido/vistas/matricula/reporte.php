<table>
	<thead>
		<tr>
			<th>Deportista</th>
			<th>Estado</th>
			<th>Año</th>
			<th>Categoría</th>
			<th>F. pago</th>
			<th>Realizado</th>
		</tr>
	</thead>
	<tbody>
		<?php if (count($matriculas) > 0): ?>
			<?php foreach ($matriculas as $matricula): ?>			
		<tr>
			<td><?= $matricula->Deportista->NombreIdentificacion ?></td>
			<td style="color:<?= $matricula->estado == 1? 'green' : 'red'; ?>"><?= $matricula->EtiquetaEstado ?></td>
			<td><?= $matricula->anio ?></td>
			<td><?= $matricula->Categoria->nombre ?></td>
			<td><?= $matricula->fecha_pago ?></td>
			<td><?= $matricula->fechaRF ?></td>
		</tr>
			<?php endforeach ?>
		<?php else: ?>
		<tr>
			<td colspan="6" class="text-center">No hay registros</td>
		</tr>
		<?php endif ?>
	</tbody>
</table>