<?php
$formulario = new CBForm(['id' => 'form-tiposdocumento']);
$formulario->abrir();
?>
<?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
<?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->lista($modelo, 'padre_id', $tiposDocumentos, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un tipo de documento']) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['tipoDocumento/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<script>
    
</script>

<?php $formulario->cerrar(); ?>