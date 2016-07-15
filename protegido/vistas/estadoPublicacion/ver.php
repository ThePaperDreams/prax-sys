<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar EstadosPublicacion' => ['EstadoPublicacion/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EstadoPublicacion/inicio'],
            'Crear' => ['EstadoPublicacion/crear'],
            'Modificar' => ['EstadoPublicacion/editar', 'id' => $modelo->id_estado],
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
                    <th><?php echo $modelo->obtenerEtiqueta('id_estado') ?></th>
                    <td><?php echo $modelo->id_estado; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre') ?></th>
                    <td><?php echo $modelo->nombre; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?php echo $modelo->descripcion; ?></td>
                </tr>
                            </tbody>
        </table>

    </div>
</div>
