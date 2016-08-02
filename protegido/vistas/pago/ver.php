<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Pagos' => ['Pago/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Pago/inicio'],
            'Crear' => ['Pago/crear'],
            'Modificar' => ['Pago/editar', 'id' => $modelo->id_pago],
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
                    <th><?php echo $modelo->obtenerEtiqueta('id_pago') ?></th>
                    <td><?php echo $modelo->id_pago; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha') ?></th>
                    <td><?php echo $modelo->fecha; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('valor_cancelado') ?></th>
                    <td><?php echo $modelo->valor_cancelado; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('url_comprobante') ?></th>
                    <td><?php echo $modelo->url_comprobante; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->estado; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('descuento') ?></th>
                    <td><?php echo $modelo->descuento; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('razon_descuento') ?></th>
                    <td><?php echo $modelo->razon_descuento; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('matricula_id') ?></th>
                    <td><?php echo $modelo->matricula_id; ?></td>
                </tr>
                            </tbody>
        </table>

    </div>
</div>
