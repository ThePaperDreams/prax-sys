<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas' => ['Deportista/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Deportista/inicio'],
        'Crear' => ['Deportista/crear'],
        'Modificar' => ['Deportista/editar', 'id' => $modelo->id_deportista],
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
                    <th><?php echo $modelo->obtenerEtiqueta('id_deportista') ?></th>
                    <td><?php echo $modelo->id_deportista; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('tipo_documento_id') ?></th>
                    <td><?php echo $tiposIdentificaciones["$modelo->tipo_documento_id"]; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('identificacion') ?></th>
                    <td><?php echo $modelo->identificacion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_nacimiento') ?></th>
                    <td><?php echo $modelo->fecha_nacimiento; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre1') ?></th>
                    <td><?php echo $modelo->nombre1; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre2') ?></th>
                    <td><?php echo $modelo->nombre2; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('apellido1') ?></th>
                    <td><?php echo $modelo->apellido1; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('apellido2') ?></th>
                    <td><?php echo $modelo->apellido2; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('direccion') ?></th>
                    <td><?php echo $modelo->direccion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('telefono1') ?></th>
                    <td><?php echo $modelo->telefono1; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('telefono2') ?></th>
                    <td><?php echo $modelo->telefono2; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado_id') ?></th>
                    <td><?php echo $estados["$modelo->estado_id"]; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Acudientes</div>
        <ul class="list-group">
            <?php foreach ($modelo->getAcudientes() as $k): ?>
                <li class="list-group-item"><?= $k->getDatos(); ?></li>
            <?php endforeach; ?>           
        </ul>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Documentos</div>
        <ul class="list-group">
            <?php foreach ($modelo->getDocumentos() as $k): ?>
                <li class="list-group-item"><?= $k->getDatos(); ?></li>
                <?php endforeach; ?>           
        </ul>
    </div>
</div>
