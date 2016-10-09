<?php 
$formulario = new CBForm(['id' => 'form-documentos']);
$formulario->abrir();
?>
<?php echo $formulario->campoTexto($modelo, 'url', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'titulo', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->lista($modelo, 'tipo_id', $tiposDocumentos, ['label' => true, 'group' => true, 'defecto' => 'Seleccione una opción']) ?>
<?php echo $formulario->campoNumber($modelo, 'papelera', ['label' => true, 'group' => true, 'min' => '0']) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['documento/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>