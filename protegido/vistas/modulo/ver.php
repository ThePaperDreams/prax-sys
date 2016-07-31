<?php
$this->tituloPagina = "Ver Módulo";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Modulos' => ['Modulo/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Modulo/inicio'],
        'Registrar' => ['Modulo/crear'],
        'Actualizar' => ['Modulo/editar', 'id' => $modelo->id],
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
