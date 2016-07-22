<?php
$formulario = new CBForm(['id' => 'form-implementos']);
$formulario->abrir();
?>

<?php echo $formulario->lista($modelo, 'categoria_id', $elementos, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto' => 'Selecciona una categoría']) ?>
<?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoNumber($modelo, 'unidades', ['label' => true, 'group' => true,'min'=>'0']) ?>
<?php echo $formulario->campoNumber($modelo, 'minimo_unidades', ['label' => true, 'group' => true,'min'=>'0']) ?>
<?php echo $formulario->campoNumber($modelo, 'maximo_unidades', ['label' => true, 'group' => true,'min'=>'0']) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['implemento/inicio'], ['class' => 'btn btn-primary btn-block', 'id' => 'btn-send']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block', 'id' => 'btnGuardar']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>
<script>

    function validar() {
        var select1 = $("#Implementos_unidades");
        var select2 = $("#Implementos_minimo_unidades");
        var select3 = $("#Implementos_maximo_unidades");
        var valor1 = select1.val();
        var valor2 = select2.val();
        var valor3 = select3.val();
        if (valor1 <= 0) {
            alert("Seleccione un valor positivo o mayor que 0");
        }
        if (valor2 <= 0) {
            alert("Seleccione un valor positivo o mayor que 0");
        }
        if (valor3 <= 0) {
            alert("Seleccione un valor positivo o mayor que 0");
        }
    }
</script>