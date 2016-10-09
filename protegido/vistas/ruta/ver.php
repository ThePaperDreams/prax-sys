<?php
$this->tituloPagina = "Ver Ruta";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Rutas' => ['Ruta/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Ruta/inicio'],
        'Registrar' => ['Ruta/crear'],
        'Actualizar' => ['Ruta/editar', 'id' => $modelo->id_ruta],
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
                    <th><?php echo $modelo->obtenerEtiqueta('nombre') ?></th>
                    <td><?php echo $modelo->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('ruta') ?></th>
                    <td><?php echo $modelo->ruta; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('modulo_id') ?></th>
                    <td><?php echo $modelo->Modulo->nombre; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
