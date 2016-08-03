<?php
$this->tituloPagina = "Ver Rol";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Roles' => ['Rol/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Rol/inicio'],
        'Registrar' => ['Rol/crear'],
        'Actualizar' => ['Rol/editar', 'id' => $modelo->id_rol],
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
</div>
