<?php 
$formulario = new CBForm(['id' => 'form-seguimientos']);
$formulario->abrir();
?>

<?php echo $formulario->campoTexto($modelo, 'tipo_seguimiento', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'estado', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'evaluacion', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'fecha', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'ficha_tecnica_id', ['label' => true, 'group' => true]) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['seguimiento/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>