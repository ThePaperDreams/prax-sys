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
            Detalles
        </div>
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('deportista_id') ?></th>
                    <td><?= CHtml::link($modelo->NombreDepCompleto, ['deportista/ver', 'id' => $modelo->deportista_id]) ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('club_origen') ?></th>
                    <td><?= $modelo->club_origen; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('club_destino') ?></th>
                    <td><?= $modelo->club_destino; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('fecha_inicio') ?></th>
                    <td><?= $modelo->fecha_inicio; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('fecha_fin') ?></th>
                    <td><?= $modelo->fecha_fin; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?= $modelo->EtiquetaEstado; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('tipo_prestamo') ?></th>
                    <td><?= $modelo->EtiquetaTipo; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
