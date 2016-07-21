<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Rutas' => ['Ruta/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Ruta/inicio'],
        'Crear' => ['Ruta/crear'],
        'Modificar' => ['Ruta/editar', 'id' => $modelo->id_ruta],
    ]
];
?>
<div class="col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('id_ruta') ?></th>
                    <td><?php echo $modelo->id_ruta; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre') ?></th>
                    <td><?php echo $modelo->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('ruta') ?></th>
                    <td><?php echo $modelo->ruta; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
