<?php 
$formulario = new CBForm(['id' => 'form-tipospublicacion']);
$formulario->abrir();
?>
<?php echo $formulario->inputAddon($modelo, 'nombre', 'texto', ['label' => true, 'group' => true, 'autofocus' => true], 'font') ?>
<?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['tipoPublicacion/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>