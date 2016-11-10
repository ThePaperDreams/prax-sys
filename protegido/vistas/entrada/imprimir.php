<div class="col-8">
	<table class="table table-bordered">
	    <tbody>
	        <tr>
	            <th class="text-left"><?php echo $modelo->obtenerEtiqueta('fecha_realizacion') ?></th>
	            <td><?php echo $modelo->fecha_realizacion; ?></td>
	        </tr>
	        <tr>
	            <th class="text-left"><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
	            <td><?php echo$modelo->descripcion == null? '&nbsp;' : $modelo->descripcion;  ?></td>
	        </tr>
	        <tr>
	            <th class="text-left"><?php echo $modelo->obtenerEtiqueta('responsable_id') ?></th>
	            <td><?php echo $modelo->Usuario->nombres; ?></td>
	        </tr>
	        <tr>
	            <th class="text-left"><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
	            <td><?php echo $modelo->EtiquetaEstado; ?></td>
	        </tr>
	    </tbody>
	</table>
</div>

<div class="row">	
	<h3>
		Implementos préstados
	</h3>
</div>

<div class="col-10">	
	<table>
		<thead>
			<tr>
				<th>
					Nombre
				</th>
				<th>
					Cantidad
				</th>
			</tr>
		</thead>
		<tbody>

		<?php foreach ($modelo->Detalles as $d): ?>		
			<tr>
				<td><?= $d->Implemento->nombre ?></td>
				<td><?= $d->cantidad ?></td>
			</tr>
		<?php endforeach ?>

		</tbody>
	</table>
</div>