<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Opmenu' => ['Opmenu/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Opmenu/inicio'],
        'Crear' => ['Opmenu/crear'],
        'Modificar' => ['Opmenu/editar', 'id' => $modelo->id],
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
                    <th><?php echo $modelo->obtenerEtiqueta('id') ?></th>
                    <td><?php echo $modelo->id; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('texto') ?></th>
                    <td><?php echo $modelo->texto; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('ruta_id') ?></th>
                    <td><?php echo $rutas["$modelo->ruta_id"]; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('padre_id') ?></th>
                    <td><?php echo ($modelo->padre_id != 0) ? $opmenus["$modelo->padre_id"] . " (Id: $modelo->padre_id)" : ""; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
