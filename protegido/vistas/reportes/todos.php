<?php
$this->tituloPagina = "Reportes";
  ?>
<div class="tile p-15">
	<div class="row">
		
		<div class="col-sm-3">

			<div class="tile p-15">
				<div class="page-header">
					<h5> <i class="fa fa-male icon-report"></i> Deportistas</h5>
				</div>
				<div class="list-group">
					<a href="<?= Sis::crearUrl(['reportes/deportistas']) ?>" class="list-group-item">Todos los deportistas</a>
					<a href="<?= Sis::crearUrl(['reportes/deportistasAcudientes']) ?>" class="list-group-item">Acudientes por deportista</a>
					<a href="<?= Sis::crearUrl(['reportes/acudientesDeportistas']) ?>" class="list-group-item">Deportistas por acudiente</a>
				</div>
			</div>

		</div>
		<div class="col-sm-3">
			
			<div class="tile p-15">
				<div class="page-header">
					<h5> <i class="fa fa-cubes icon-report"></i> Implementos</h5>
				</div>
				<div class="list-group">
					<a href="<?= Sis::crearUrl(['reportes/implementos']) ?>" class="list-group-item">Implementos del club</a>
					<a href="<?= Sis::crearUrl(['reportes/implementosPrestados']) ?>" class="list-group-item">Préstamos realizados</a>
					<a href="<?= Sis::crearUrl(['reportes/implementosEntradas']) ?>" class="list-group-item">Entradas realizadas</a>
				</div>
			</div>

		</div>
		<div class="col-sm-3">
			
			<div class="tile p-15">
				<div class="page-header">
					<h5> <i class="fa fa-money icon-report"></i> Pagos</h5>
				</div>
				<div class="list-group">
					<a href="<?= Sis::crearUrl(['reportes/pagosPendientes']) ?>" class="list-group-item">Mensualidades atrasadas</a>
					<a href="<?= Sis::crearUrl(['reportes/pagosRealizados']) ?>" class="list-group-item">Pagos realizados</a>
				</div>
			</div>

		</div>

		<div class="col-sm-3">
			
			<div class="tile p-15">
				<div class="page-header">
					<h5> <i class="fa fa-trophy icon-report"></i> Torneos</h5>
				</div>
				<div class="list-group">

				</div>
			</div>

		</div>



	</div>
</div>