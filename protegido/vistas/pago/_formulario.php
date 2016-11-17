<?php 
$formulario = new CBForm(['id' => 'form-pagos']);
$formulario->abrir();
?>
<div class="col-sm-6">
	<?php echo $formulario->campoTexto($modelo, 'fecha', ['label' => true, 'group' => true, 'autofocus' => true, 'readonly' => true]) ?>
</div>
<div class="col-sm-6">	
	<?php echo $formulario->campoTexto($modelo, 'valor_cancelado', ['label' => true, 'group' => true, 'class' => 'solo-numeros']) ?>
</div>
<?php echo $formulario->campoTexto($modelo, 'url_comprobante', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'estado', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'descuento', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'razon_descuento', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'matricula_id', ['label' => true, 'group' => true]) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['pago/pagosPendientes'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>