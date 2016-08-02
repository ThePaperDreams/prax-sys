<?php 
$formulario = new CBForm(['id' => 'form-tiposevento']);
$formulario->abrir();
?>
<div class="tile p-15">
<?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>

    <div class="row">
        <div class="col-sm-offset-6 col-sm-3">
            <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['tipoEvento/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
        </div>
        <div class="col-sm-3">
            <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
        </div>
    </div>
</div>
<?php $formulario->cerrar(); ?>