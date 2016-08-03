<?php
$formulario = new CBForm(['id' => 'form-prestamosdeportista']);
$formulario->abrir();
?>
<!--<div class="btn-group" data-toggle="buttons">
    <label class="btn btn-gr-gray btn-sm active">
        <input type="radio" name="options" id="option1"> Salida
    </label>
    <label class="btn btn-gr-gray btn-sm">
        <input type="radio" name="options" id="option2"> Llegada
    </label>
</div>-->
<div class="form-group">
    <label>Tipo de préstamo</label>
    <div class="form-group">        
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-gr-gray btn-sm active">
                <input type="radio" name="PrestamosDeportista[tipo_prestamo]" id="option1" checked="true" value="0"> Salida <i class="fa fa-arrow-circle-up"></i>
            </label>
            <label class="btn btn-gr-gray btn-sm">
                <input type="radio" name="PrestamosDeportista[tipo_prestamo]" id="option2" value="1"> Entrada <i class="fa fa-arrow-circle-down"></i>
            </label>
        </div>
    </div>
</div>
<?php echo $formulario->lista($modelo, 'deportista_id', $deportistas, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un deportista', 'data-s2' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'clubOrigen', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'clubDestino', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'fecha_inicio', ['label' => true, 'group' => true, 'data-date' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'fecha_fin', ['label' => true, 'group' => true, 'data-date' => true]) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['prestamoDeportista/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>