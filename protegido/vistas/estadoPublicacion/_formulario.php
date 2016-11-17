<?php 
$formulario = new CBForm(['id' => 'form-estadospublicacion']);
$formulario->abrir();
?>
<div class="tile p-15">
    <div class="row">
        
    
        <?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true, 'maxlength' => 50]) ?>
        <div class="form-group">
            <label for="">Descripción <span id="total-chars">0</span>/<span id="max-chars">500</span> </label>
            <?php echo $formulario->areaTexto($modelo, 'descripcion', ['rows' => 8]) ?>
        </div>

        <div class="row">
            <div class="col-sm-offset-6 col-sm-3">
                <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['estadoPublicacion/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
            </div>
            <div class="col-sm-3">
                <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
            </div>
        </div>
        
    </div>
</div>

<?php $formulario->cerrar(); ?>

<script>
	$(function(){
		$("#EstadosPublicacion_descripcion").keydown(function(e){
            var t = $(this);
            var max = parseInt($("#max-chars").html());
            $("#total-chars").html(t.val().length);
            if(t.val().length >= max && ( e.which != 8 && e.which !== 116)){
                e.preventDefault();
                return false;
            }
        });
	});
</script>
