<?php
$this->tituloPagina = "Ver Usuario";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Usuarios' => ['Usuario/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Usuario/inicio'],
        'Registrar' => ['Usuario/crear'],
        'Actualizar' => ['Usuario/editar', 'id' => $modelo->id_usuario],
    ]
];
?>
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombres') ?></th>
                    <td><?php echo $modelo->nombres; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('apellidos') ?></th>
                    <td><?php echo $modelo->apellidos; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('rol_id') ?></th>
                    <td><?php echo $modelo->Rol->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre_usuario') ?></th>
                    <td><?php echo $modelo->nombre_usuario; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('email') ?></th>
                    <td><?php echo $modelo->email; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('telefono') ?></th>
                    <td><?php echo $modelo->telefono; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->EtiquetaEstado ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
