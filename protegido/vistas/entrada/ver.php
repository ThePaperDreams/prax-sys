<?php
$this->tituloPagina = "Ver entrada de implementos";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar entradas' => ['Entrada/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Entrada/inicio'],
        'Registrar' => ['Entrada/crear'],
    ]
];
?>
<div class="col-sm-12">
    
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Información
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th><?php echo $modelo->obtenerEtiqueta('fecha_realizacion') ?></th>
                        <td><?php echo $modelo->fecha_realizacion; ?></td>
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
                    <tr>
                        <th colspan="2">
                            <a class="btn btn-primary btn-block" target="_blank" href="<?= Sis::crearUrl(['entrada/imprimir', 'id' => $modelo->id_entrada]) ?>">
                                Enviar a PDF
                            </a>
                        </th>
                    </tr>
                </tbody>
            </table>

        </div>        
    </div>
    <div class="col-sm-6">
        
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Ver detalles
            </div>
            <table class="table table-bordered">
                <thead>
                    <th>Implemento</th>
                    <th>Cantidad</th>
                </thead>
                <tbody>
                    <?php foreach ($modelo->Detalles as $key => $detalle): ?>
                        <tr>
                            <td><?= $detalle->Implemento->nombre ?></td>
                            <td><?= $detalle->cantidad ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>

</div>
