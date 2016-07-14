<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Ver Matriculas' => ['Matricula/inicio'],
    'Detalles de matricula'
];

$this->opciones = [
    'elementos' => [
        'Ver Matriculas' => ['Matricula/inicio'],
        'Matricular deportista' => ['Matricula/matricular'],
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
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_pago') ?></th>
                    <td><?php echo $modelo->fecha_pago; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_realizacion') ?></th>
                    <td><?php echo $modelo->fecha_realizacion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('url_comprobante') ?></th>
                    <td><?php echo $modelo->Comprobante; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->EtiquetaEstado; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('deportista_id') ?></th>
                    <td><?php echo $modelo->Deportista->NombreIdentificacion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('categoria_id') ?></th>
                    <td><?php echo $modelo->Categoria->nombre; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
