<?php
$this->tituloPagina = "Ver matricula";
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
            Detalles
        </div>
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('fecha_pago') ?></th>
                    <td><?= $modelo->fecha_pago; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('fecha_realizacion') ?></th>
                    <td><?= $modelo->fecha_realizacion; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('url_comprobante') ?></th>
                    <td><?= $modelo->Comprobante; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?= $modelo->EtiquetaEstado; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('deportista_id') ?></th>
                    <td>
                        <?= CHtml::link($modelo->Deportista->NombreIdentificacion, ['deportista/ver', 'id' => $modelo->deportista_id]) ?>
                    </td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('categoria_id') ?></th>
                    <td><?= $modelo->Categoria->nombre; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
