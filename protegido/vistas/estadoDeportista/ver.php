<?php 
    $this->tituloPagina = "Ver Estado de Deportista";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Estados de Deportistas' => ['EstadoDeportista/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EstadoDeportista/inicio'],
            'Registrar' => ['EstadoDeportista/crear'],
            'Actualizar' => ['EstadoDeportista/editar', 'id' => $modelo->id_estado],
        ]
    ];
?>
<div class="col-sm-12">
    <div class="panel panel-default">
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
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('icono') ?></th>
                    <td><?php echo $modelo->icono; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('etiqueta') ?></th>
                    <td><?php echo $modelo->etiqueta; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
