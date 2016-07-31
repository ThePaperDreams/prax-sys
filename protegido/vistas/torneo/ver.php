<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Torneos' => ['Torneo/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Torneo/inicio'],
        'Crear' => ['Torneo/crear'],
        'Modificar' => ['Torneo/editar', 'id' => $modelo->id_torneo],
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
                    <th><?php echo $modelo->obtenerEtiqueta('nombre') ?></th>
                    <td><?php echo $modelo->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('cupo_maximo') ?></th>
                    <td><?php echo $modelo->cupo_maximo; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('cupo_minimo') ?></th>
                    <td><?php echo $modelo->cupo_minimo; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('edad_maxima') ?></th>
                    <td><?php echo $modelo->edad_maxima; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('edad_minima') ?></th>
                    <td><?php echo $modelo->edad_minima; ?></td>
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
                    <th><?php echo $modelo->obtenerEtiqueta('observaciones') ?></th>
                    <td><?php echo $modelo->observaciones; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('tabla_posiciones') ?></th>
                    <td><?php echo $modelo->tabla_posiciones; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('equipo_id') ?></th>
                    <td><?php echo $modelo->equipo_id; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>