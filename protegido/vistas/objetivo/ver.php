<?php
$this->tituloPagina = "Ver objetivo";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Objetivos' => ['Objetivo/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Objetivo/inicio'],
        'Registrar' => ['Objetivo/crear'],
        'Modificar' => ['Objetivo/editar', 'id' => $modelo->id_objetivo],
    ]
];
?>
<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-hover">
            <tbody>               
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('titulo') ?></th>
                    <td><?php echo $modelo->titulo; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?php echo $modelo->descripcion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('plan_trabajo_id') ?></th>
                    <td><?php echo $modelo->plan_trabajo_id; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
