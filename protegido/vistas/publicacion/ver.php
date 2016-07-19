<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Publicaciones' => ['Publicacion/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Publicacion/inicio'],
        'Crear' => ['Publicacion/crear'],
        'Modificar' => ['Publicacion/editar', 'id' => $modelo->id_publicacion],
    ]
];
?>
<div class="col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('id_publicacion') ?></th>
                    <td><?php echo $modelo->id_publicacion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('titulo') ?></th>
                    <td><?php echo $modelo->titulo; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('contenido') ?></th>
                    <td><?php echo $modelo->contenido; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('consecutivo') ?></th>
                    <td><?php echo $modelo->consecutivo; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_publicacion') ?></th>
                    <td><?php echo $modelo->fecha_publicacion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_disponibilidad') ?></th>
                    <td><?php echo $modelo->fecha_disponibilidad; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('tipo_id') ?></th>
                    <td><?php echo $public["$modelo->tipo_id"] ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('lugar') ?></th>
                    <td><?php echo $modelo->lugar; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('hora') ?></th>
                    <td><?php echo $modelo->hora; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado_id') ?></th>
                    <td><?php echo $estd["$modelo->estado_id"] ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('usuario_id') ?></th>    
                    <td><?php echo $modelo->Autor->nombres ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
