<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Eventos' => ['Evento/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Evento/inicio'],
        'Crear' => ['Evento/crear'],
        'Modificar' => ['Evento/editar', 'id' => $modelo->id_evento],
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
                    <th><?php echo $modelo->obtenerEtiqueta('titulo') ?></th>
                    <td><?php echo $modelo->titulo; ?></td>
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
                    <td><?php echo $modelo->TipoEvento->nombre; ?></td>
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
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->Estado->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('autor') ?></th>
                    <td><?php echo $modelo->Autor->nombres ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
