<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar PlanesTrabajo' => ['PlanTrabajo/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['PlanTrabajo/inicio'],
        'Crear' => ['PlanTrabajo/crear'],
        'Modificar' => ['PlanTrabajo/editar', 'id' => $modelo->id_plan_trabajo],
    ]
];
?>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('categoria_id') ?></th>
                    <td><?php echo $modelo->Categoria->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_aplicacion') ?></th>
                    <td><?php echo $modelo->fecha_aplicacion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->EstadoEtiqueta; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?php echo $modelo->descripcion; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Objetivos del plan
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($detalles AS $objetivo): ?>
                <tr>
                    <td><?= $objetivo->titulo ?></td>
                    <td><?= $objetivo->descripcion ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
