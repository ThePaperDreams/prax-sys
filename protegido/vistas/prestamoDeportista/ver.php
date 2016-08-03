<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar PrestamosDeportista' => ['PrestamoDeportista/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['PrestamoDeportista/inicio'],
            'Crear' => ['PrestamoDeportista/crear'],
            'Modificar' => ['PrestamoDeportista/editar', 'id' => $modelo->id_prestamo],
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
                    <th><?php echo $modelo->obtenerEtiqueta('id_prestamo') ?></th>
                    <td><?php echo $modelo->id_prestamo; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('clubOrigen') ?></th>
                    <td><?php echo $modelo->clubOrigen; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('clubDestino') ?></th>
                    <td><?php echo $modelo->clubDestino; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_inicio') ?></th>
                    <td><?php echo $modelo->fecha_inicio; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_fin') ?></th>
                    <td><?php echo $modelo->fecha_fin; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->estado; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('deportista_id') ?></th>
                    <td><?php echo $modelo->deportista_id; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('tipo_prestamo') ?></th>
                    <td><?php echo $modelo->tipo_prestamo; ?></td>
                </tr>
                            </tbody>
        </table>

    </div>
</div>
