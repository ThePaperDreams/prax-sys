<?php 
$formulario = new CBForm(['id' => 'form-rutas']);
$formulario->abrir();
?>
<?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'ruta', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->lista($modelo, 'modulo_id', $modulos, ['label' => true, 'group' => true, 'defecto' => '']) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['ruta/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>