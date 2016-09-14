<?php
$this->tituloPagina = "Ver torneo";

$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Torneos' => ['Torneo/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Torneo/inicio'],
        'Crear' => ['Torneo/crear'],
        'Modificar' => ['Torneo/editar', 'id' => $modelo->id_torneo],
    ]
];
?>


<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Ver detalles
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th><?php echo $modelo->obtenerEtiqueta('nombre') ?></th>
                        <td><?php echo $modelo->nombre; ?></td>
                        <th><?php echo $modelo->obtenerEtiqueta('cupo_maximo') ?></th>
                        <td><?php echo $modelo->cupo_maximo; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $modelo->obtenerEtiqueta('cupo_minimo') ?></th>
                        <td><?php echo $modelo->cupo_minimo; ?></td>
                        <th><?php echo $modelo->obtenerEtiqueta('fecha_inicio') ?></th>
                        <td><?php echo $modelo->fecha_inicio; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $modelo->obtenerEtiqueta('fecha_fin') ?></th>
                        <td><?php echo $modelo->fecha_fin; ?></td>
                        <th><?php echo $modelo->obtenerEtiqueta('observaciones') ?></th>
                        <td><?php echo $modelo->observaciones; ?></td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center"><?php echo $modelo->getTabla(); ?></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- fin panel -->
    
</div>
<div class="row">
    <div class="col-sm-12">
        <h3>Equipos</h3>
        <div class="tile p-15">
            <a href="<?= Sis::CrearUrl(['torneo/gestionarEquipos', 'id' => $modelo->id_torneo]) ?>" class="btn btn-primary"> Gestionar equipos </a>
            <a href="<?= Sis::CrearUrl(['torneo/registrarResultados', 'id' => $modelo->id_torneo]) ?>" class="btn btn-success"> Registrar resultados </a>
            <div class="p-15">
            </div>
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
                        <div class="col-sm-4">
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
                        <div class="col-sm-8">
                            <ul class="container-jugadores"> 
                            <?php foreach($equipo->JugadoresE AS $jugador): ?>
                                <li>
                                    <div id="deportista-2" data-id="2">
                                        <div class="deportista-equipo row">
                                            <div class="pic col-sm-3">
                                            <?php if($jugador->Deportista->foto === "" || $jugador->Deportista->foto === null): ?>
                                                <img src="<?= Sis::UrlBase() ?>/publico/imagenes/deportistas/fotos/sin-foto.jpg">
                                            <?php else: ?>
                                                <img src="<?= Sis::UrlBase()?>/publico/imagenes/deportistas/fotos/thumbs/tmb_<?= $jugador->Deportista->foto ?>">
                                            <?php endif ?>
                                            </div>
                                            <div class="info col-sm-9">
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
