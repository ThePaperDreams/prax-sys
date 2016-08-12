<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar EquiposTorneos' => ['EquipoTorneo/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EquipoTorneo/inicio'],
            'Crear' => ['EquipoTorneo/crear'],
            'Modificar' => ['EquipoTorneo/editar', 'id' => $modelo->id_et],
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
                    <th><?php echo $modelo->obtenerEtiqueta('id_et') ?></th>
                    <td><?php echo $modelo->id_et; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('equipo_id') ?></th>
                    <td><?php echo $modelo->equipo_id; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('torneo_id') ?></th>
                    <td><?php echo $modelo->torneo_id; ?></td>
                </tr>
                            </tbody>
        </table>

    </div>
</div>
