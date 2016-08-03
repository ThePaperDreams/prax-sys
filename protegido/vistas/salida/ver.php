<?php
$this->tituloPagina = "Ver salida de implementos";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar salida de implementos' => ['Salida/inicio'],
    'Ver salida de implementos'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Salida/inicio'],
        'Crear' => ['Salida/crear'],
    ]
];
?>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_realizacion') ?></th>
                    <td><?php echo $modelo->fecha_realizacion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_entrega') ?></th>
                    <td><?php echo $modelo->fecha_entrega; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?php echo $modelo->descripcion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('responsable_id') ?></th>
                    <td><?php echo $modelo->Usuario->nombres; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->EtiquetaEstado; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Cantidad
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Implemento</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($modelo->Detalles AS $detalle): ?>
                <tr>
                    <td>
                            <?= $detalle->Implemento->nombre ?>  
                        
                    </td>
                    <td>
                        <?= $detalle->cantidad ?> <br>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>



