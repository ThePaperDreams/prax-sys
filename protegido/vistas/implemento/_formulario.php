<?php 
$formulario = new CBForm(['id' => 'form-implementos']);
$formulario->abrir();
?>

<?php echo $formulario->lista($modelo, 'categoria_id', $elementos, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto' => 'Selecciona una categoría']) ?>
<?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoNumber($modelo, 'unidades', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoNumber($modelo, 'minimo_unidades', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoNumber($modelo, 'maximo_unidades', ['label' => true, 'group' => true]) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['implemento/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>