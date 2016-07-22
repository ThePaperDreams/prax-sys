<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Equipos' => ['Equipo/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Equipo/inicio'],
            'Crear' => ['Equipo/crear'],
            'Modificar' => ['Equipo/editar', 'id' => $modelo->id_equipo],
        ]
    ];
?>
<div class="col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('id_equipo') ?></th>
                    <td><?php echo $modelo->id_equipo; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('cupo_maximo') ?></th>
                    <td><?php echo $modelo->cupo_maximo; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('cupo_minimo') ?></th>
                    <td><?php echo $modelo->cupo_minimo; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->estado; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('posicion') ?></th>
                    <td><?php echo $modelo->posicion; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('entrenador_id') ?></th>
                    <td><?php echo $modelo->entrenador_id; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('deportista_id') ?></th>
                    <td><?php echo $modelo->deportista_id; ?></td>
                </tr>
                            </tbody>
        </table>

    </div>
</div>
