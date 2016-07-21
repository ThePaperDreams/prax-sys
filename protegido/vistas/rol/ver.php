<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Roles' => ['Rol/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Rol/inicio'],
        'Crear' => ['Rol/crear'],
        'Modificar' => ['Rol/editar', 'id' => $modelo->id_rol],
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
                    <th><?php echo $modelo->obtenerEtiqueta('id_rol') ?></th>
                    <td><?php echo $modelo->id_rol; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre') ?></th>
                    <td><?php echo $modelo->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?php echo $modelo->descripcion; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="lst-rut" class="panel panel-primary">
        <div class="panel-heading">Rutas</div>
        <ul id="lis-rut" class="list-group">
            <?php foreach ($modelo->getRutas() as $k): ?>
                <li class="list-group-item"><?= $k->getDatos(); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
