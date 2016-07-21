<?php 
$formulario = new CBForm(['id' => 'form-opmenu']);
$formulario->abrir();
?>
<?php echo $formulario->campoTexto($modelo, 'texto', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
<?php echo $formulario->lista($modelo, 'ruta_id', $rutas, ['label' => true, 'group' => true, 'defecto'=>'Seleccione una Ruta']) ?>
<?php echo $formulario->lista($modelo, 'padre_id', $opmenus, ['label' => true, 'group' => true, 'defecto'=>'Seleccione una Opmenu']) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['opmenu/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>