<?php 
$this->tituloPagina = "Registrar resultados";

$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Torneos' => ['Torneo/inicio'],
    $torneo->nombre => ['Torneo/ver', 'id' => $torneo->id_torneo],
    'Registrar resultados',
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Torneo/inicio'],
        'Registrar' => ['Torneo/crear'],
        'Modificar' => ['Torneo/editar', 'id' => $torneo->id_torneo],
    ]
];

 ?>
<div class="tile">

<div class="row">
    <div class="col-sm-12">
        <div class="tile p-15">
            <ul class="nav nav-tabs" role="tablist">
                <?php foreach($equipos AS $k=>$equipo): ?>
                <li role="presentation" class="<?= $k == 0? 'active' : '' ?>">
                    <a href="#<?= "equipo-$equipo->id" ?>" aria-controls="<?= "equipo-$equipo->id" ?>" role="tab" data-toggle="tab"><?= $equipo->nombre ?></a>
                </li>
                <?php endforeach ?>
            </ul>
            <div class="tab-content">
                <?php foreach($equipos AS $k=>$equipo): ?>
                <div role="tabpanel" class="tab-pane <?= $k == 0? 'active' : '' ?>" id="<?= "equipo-$equipo->id" ?>">                    
                    <div class="row">
                        <div class="col-sm-3">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Max. jugadores</th>
                                    <td><?= $equipo->cupo_maximo ?></td>
                                </tr>
                                <tr>
                                    <th>No. Jugadores</th>
                                    <td><?= $equipo->TotalJugadores ?></td>
                                </tr>
                                <tr>
                                    <th>Entrenador</th>
                                    <td><?= $equipo->Entrenador->NombreCompleto ?></td>
                                </tr>
                                <tr>
                                    <th>Posición</th>
                                    <td><?= $equipo->TxtPos  ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-9">
                            <ul class="container-jugadores"> 
                            <?php foreach($equipo->JugadoresE AS $jugador): ?>
                                <li>
                                    <div id="deportista-2" data-id="2">
                                        <div class="deportista-equipo row">
                                            <div class="pic col-sm-2">
                                            <?php if($jugador->Deportista->foto === "" || $jugador->Deportista->foto === null): ?>
                                                <img src="<?= Sis::UrlBase() ?>/publico/imagenes/deportistas/fotos/sin-foto.jpg">
                                            <?php else: ?>
                                                <img src="<?= Sis::UrlBase()?>/publico/imagenes/deportistas/fotos/thumbs/tmb_<?= $jugador->Deportista->foto ?>">
                                            <?php endif ?>
                                            </div>
                                            <div class="info col-sm-5">
                                                <table class="table-info table table-bordered table-condensed" id="table-expanded-2">
                                                    <tbody><tr>
                                                        <td>Nombre: </td>
                                                        <td><?= $jugador->Deportista->nombreCompleto ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Edad: </td>
                                                        <td><?= $jugador->Deportista->Edad ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Categoría: </td>
                                                        <td><?= $jugador->Deportista->NombreCategoria ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Posición: </td>
                                                        <td><?= $jugador->Deportista->Ficha->Pos ?></td>
                                                    </tr>
                                                </tbody></table>
                                            </div>
											
											<div class="col-sm-5">
												<table id="tabla-info-<?= $jugador->id_de ?>" data-id="<?= $jugador->id_de ?>" class="table table-bordered table-condensed">
													<tr>
														<td>Expulsiones: </td>
														<td class="expulsiones"><?= $jugador->expulsiones ?></td>
													</tr>
													<tr>
														<td>Amonestaciones: </td>
														<td class="amonestaciones"><?= $jugador->amonestaciones ?></td>
													</tr>
													<tr>
														<td>Anotaciones: </td>
														<td class="anotaciones"><?= $jugador->anotaciones ?></td>
													</tr>
													<tr>
														<td colspan="2" data-target="<?= $jugador->id_de ?>">
															<div class="col-sm-12 edit-container">
																<button class="btn btn-primary btn-block btn-update">
																	Editar 
																	<i class="fa fa-pencil"></i>
																</button>
															</div>
															<div class="col-sm-12 controles" style="display:none">
																<button class="btn btn-default col-sm-6 btn-cancel" data-target="<?= $jugador->id_de ?>">
																	Cancelar	
																</button>
																<button class="btn btn-success col-sm-6 btn-save" data-target="<?= $jugador->id_de ?>">
																	Guardar 
																	<i class="fa fa-floppy-o"></i>
																</button>																
															</div>
														</td>
													</tr>
												</table>
											</div>

                                        </div>
                                    </div>
                                </li>
                            <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>



</div>

<script>
	$(function(){
		$(".btn-update").click(function(){
			var contenedor = $(this).closest("td");
			contenedor.find(".edit-container").slideUp();
			contenedor.find(".controles").slideDown();
			habilitarCampos(contenedor.attr("data-target"));
		});

		$(".btn-cancel").click(function(){
			removerCampos();
		});

		$(".btn-save").click(function(){
			var contenedor = $(this).closest("td");
			guardarCampos(contenedor.attr("data-target"));
		});
	});

	function guardarCampos(target){
		var tabla = $("#tabla-info-" + target);
		var id = tabla.attr("data-id");

		var inputAnot = tabla.find("[data-type='1']");
		var inputAmon = tabla.find("[data-type='2']");
		var inputExpu = tabla.find("[data-type='3']");

		$.ajax({
			'type' : 'POST',
			'url' : '<?= Sis::crearUrl(["torneo/registrarResultados", "id" => $torneo->id]) ?>', 
			'data' : {
				'data-save-fields' : true,
				'jug-id' : id,
				anotaciones : inputAnot.val(),
				amonestaciones : inputAmon.val(),
				expulsiones : inputExpu.val(),
			}
		}).done(function(data){
			if(data.error == false){
				lobiAlert("success", "Se guardó correctamente la información");
				removerCampos();
			} else if(data.error == true){
				lobiAlert("error", "Ocurrió un error al guardar la información");
			} else {
				console.log(data);
				lobiAlert("error", "Ocurió un error inesperado");
			}
		});
	}

	function habilitarCampos(id){
		removerCampos();
		var tabla = $("#tabla-info-" + id);
		var anotaciones = tabla.find(".anotaciones");
		var amonestaciones = tabla.find(".amonestaciones");
		var expulsiones = tabla.find(".expulsiones");

		var inputAnot = $("<input/>", { type: 'number', class : "input-tmp form-control", 'data-type' : '1'}).val(anotaciones.html());
		var inputAmon = $("<input/>", { type: 'number', class : "input-tmp form-control", 'data-type' : '2'}).val(amonestaciones.html());
		var inputExpu = $("<input/>", { type: 'number', class : "input-tmp form-control", 'data-type' : '3'}).val(expulsiones.html());

		anotaciones.html(inputAnot);
		amonestaciones.html(inputAmon);
		expulsiones.html(inputExpu);
		inputExpu.focus().select();

		tabla.attr("data-opened", "true");
	}

	function removerCampos(){
		var tabla = $("[data-opened='true']");
		if(tabla.length == 0){
			return false;
		}
		var anotaciones = tabla.find(".anotaciones");
		var amonestaciones = tabla.find(".amonestaciones");
		var expulsiones = tabla.find(".expulsiones");		

		var inputAnot = tabla.find("[data-type='1']");
		var inputAmon = tabla.find("[data-type='2']");
		var inputExpu = tabla.find("[data-type='3']");


		var valorAnot = inputAnot.val();
		var valorAmon = inputAmon.val();
		var valorExpu = inputExpu.val();

		anotaciones.html(valorAnot);
		amonestaciones.html(valorAmon);
		expulsiones.html(valorExpu);

		tabla.find(".controles").slideUp();
		tabla.find(".edit-container").slideDown();
		tabla.removeAttr("data-opened");
	}

</script>