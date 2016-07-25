<?php 
$formulario = new CBForm(['id' => 'form-objetivos']);
$formulario->abrir();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Datos del objetivo
    </div>
    <div class="panel-body">
        <p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
        <hr>    
        <?php echo $formulario->campoTexto($modelo, 'titulo', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
        <?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
              <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['objetivo/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
            </div>
            <div class="col-sm-4">
              <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
            </div>
        </div>  
    </div>
</div>

<?php $formulario->cerrar(); ?>
<?php
    $script = '$("#form-objetivos").submit(function(){validarObjetivo(); return false;});'
            . 'function validarObjetivo(){'
                . 'if($.trim($("#Objetivos_titulo").val()) === ""){ return false; }'
                . '$.ajax({'
                    . 'type:"POST",'
                    . 'url:"' . Sis::crearUrl(['Objetivo/crear']) . '",'
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