<?php 
$formulario = new CBForm(['id' => 'form-objetivos']);
$formulario->abrir();
?>
<div class="tile p-15">
    <p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
    <hr>    
    <?php echo $formulario->campoTexto($modelo, 'titulo', ['label' => true, 'group' => true, 'autofocus' => true, 'maxlength' => 20]) ?>
    <div class="form-group">
        <label for="">Descripción <span id="total-chars">0</span>/<span id="max-chars">500</span> </label>
        <?php echo $formulario->areaTexto($modelo, 'descripcion', ['rows' => 6]) ?>
    </div>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
          <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['objetivo/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
        </div>
        <div class="col-sm-4">
          <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
        </div>
    </div>
</div>
<script>
    $(function(){
        $("#Objetivos_descripcion").keydown(function(e){
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
<?php $formulario->cerrar(); ?>
<?php
    $script = '$("#form-objetivos").submit(function(){validarObjetivo(); return false;});'
            . 'function validarObjetivo(){'
                . 'if($.trim($("#Objetivos_titulo").val()) === ""){ return false; }'
                . '$.ajax({'
                    . 'type:"POST",'
                    . 'url:"' . $url . '",'
                    . 'data:{'
                        . 'obj:$("#Objetivos_titulo").val(),'
                    . '},'
                    . 'success: function(obj){'
                        . 'if(obj.existe){'
                            . 'mostrarAlerta("error", "Ya hay un objetivo registrado con ese nombre");'
                            . '$("#Objetivos_titulo").focus().select();'
                        . '} else {'
                            . 'document.getElementById("form-objetivos").submit();'
                        . '}'
                    . '},'
                . '});'
            . '}'
            . 'function mostrarAlerta(tipo, msg){'
                . 'Lobibox.notify(tipo,{'
                    . 'size:"mini",'
                    . 'showClass:"bounceInRight",'
                    . 'hideClass:"bounceOutRight",'
                    . 'msg:msg,'
                    . 'delay:8000,'
                    . 'soundPath:"' . Sis::UrlRecursos() . 'librerias/lobibox/sounds/",'
                . '});'
            . '}';
    Sis::Recursos()->Script($script, CMRecursos::POS_READY);
?>