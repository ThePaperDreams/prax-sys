<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Consultar pagos' => ['Pago/consultar'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Consultar pagos' => ['Pago/consultar'],
    ]
];
?>
<div class="col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered ">
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
                    <th><?php echo $modelo->obtenerEtiqueta('valorFormateado') ?></th>
                    <td><?php echo $modelo->valor_cancelado; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('url_comprobante') ?></th>
                    <td><?php echo $modelo->UrlDescarga; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->etiquetaEstado; ?></td>
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
                    <td><?php echo $modelo->MatriculaPago->Deportista->nombreCompleto; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
