<?php
$this->tituloPagina="Devolver Implementos";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Salidas' => ['Salida/inicio'],
    'Entregar',
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Salida/inicio'],
        'Registrar' => ['Salida/crear'],
    ]
];
$formulario = new CBForm(['id' => 'form-entregas']);
$formulario->abrir();
?>

<div class="tile p-15">
    <div class="row">
        <input type="hidden" name="id_salida" value="<?= $modelo->id_salida ?>">
        <div class="col-sm-6">
            <table class="table table-bordered table-hover">
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
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table table-bordered table-hover">
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
                                <div class="input-group">
                                    <input type="hidden" class="form-control" name="implementos[id][]" placeholder="Cantidad" value="<?= $detalle->id_si ?>">                                    
                                    <input type="number" class="form-control" name="implementos[cantidad][]" placeholder="Cantidad" value="<?= $detalle->cantidad ?>" min="0" max="<?= $detalle->cantidad ?>">
                                  <div class="input-group-addon max">
                                        <?= $detalle->cantidad ?>
                                  </div>
                                </div>                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">        
        <div class="col-sm-offset-6 col-sm-3">
            <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['salida/inicio'], ['class' => 'btn btn-primary btn-block', 'id' => 'btn-send']); ?>
        </div>
        <div class="col-sm-3">
            <?= CBoot::boton(CBoot::fa('truck').' Entregar', 'success btn-block') ?>
        </div>
    </div>
</div>
<?php $formulario->cerrar() ?>