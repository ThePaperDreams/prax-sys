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
                    <td><?php echo $modelo->Entrenador->nombre_usuario ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('torneo_id') ?></th>
                    <td><?php echo $modelo->mTorneo->nombre?></td>
                </tr>

                                
            </tbody>
        </table>

    </div>
</div>
