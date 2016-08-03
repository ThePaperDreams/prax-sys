<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Categorías' => ['Categoria/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Categoria/inicio'],
        'Crear' => ['Categoria/crear'],
        'Modificar' => ['Categoria/editar', 'id' => $modelo->id_categoria],
    ]
];
?>
<div class="col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('nombre') ?></th>
                    <td><?= $modelo->nombre; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?= $modelo->descripcion; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('cupo_maximo') ?></th>
                    <td><?= $modelo->cupo_maximo; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('cupo_minimo') ?></th>
                    <td><?= $modelo->cupo_minimo; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('tarifa') ?></th>
                    <td><?= $modelo->tarifa; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('edad_minima') ?></th>
                    <td><?= $modelo->edad_minima; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('edad_maxima') ?></th>
                    <td><?= $modelo->edad_maxima; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?= $modelo->etiquetaEstado; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('entrenador_id') ?></th>
                    <td><?= $modelo->Entrenador->nombres; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>