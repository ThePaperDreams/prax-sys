<?php 
$formulario = new CBForm(['id' => 'form-categorias']);
$formulario->abrir();
?>
<div class="tile p-15">
    <p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
    <hr>    
    <div class="row">
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->inputAddon($modelo, 'tarifa', 'number', ['label' => true, 'class' => 'text-right', 'group' => true], ['pre' => CBoot::fa('dollar')]) ?>
        </div>
    </div>
    <?php echo $formulario->lista($modelo, 'entrenador_id', $entrenadores, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un entrenador', 'data-s2' => true]) ?>
    <?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>
    <div class="row">
        <div class="col-sm-3">
            <?php echo $formulario->campoNumber($modelo, 'cupo_minimo', ['label' => true, 'class' => 'text-right solo-numeros', 'group' => true, 'min' => 0]) ?>
        </div>
        <div class="col-sm-3">
            <?php echo $formulario->campoNumber($modelo, 'cupo_maximo', ['label' => true, 'class' => 'text-right solo-numeros', 'group' => true, 'min' => 0]) ?>        
        </div>
        <div class="col-sm-3">
            <?php echo $formulario->campoNumber($modelo, 'edad_minima', ['label' => true, 'class' => 'text-right solo-numeros', 'group' => true, 'min' => 0]) ?>
        </div>
        <div class="col-sm-3">
            <?php echo $formulario->campoNumber($modelo, 'edad_maxima', ['label' => true, 'class' => 'text-right solo-numeros', 'group' => true, 'min' => 0]) ?>            
        </div>
    </div>    
    <hr>
    <div class="row">
        <div class="col-sm-offset-6 col-sm-3">
            <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['categoria/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
        </div>
        <div class="col-sm-3">
            <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
        </div>
    </div>    
</div>

<?php $formulario->cerrar(); ?>
<?php
    $script = '$(function(){$("#form-categorias").submit(function(){validarCategoria(); return false;});});'
            . 'function validarCategoria(){'
                . 'if($.trim($("#Categorias_nombre").val()) === ""){ return false; }'
                . '$.ajax({'
                    . 'type:"POST",'
                    . 'url:"' . $url . '",'
                    . 'data:{'
                        . 'nombre:$("#Categorias_nombre").val(),'
                    . '},'
                    . 'success: function(obj){'
                        . 'if(obj.existe){'
                            . 'mostrarAlerta("error", "Ya hay una categoría registrada con ese nombre");'
                            . '$("#Categorias_nombre").focus().select();'
                        . '} else {'
                            . 'document.getElementById("form-categorias").submit();'
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
    Sis::Recursos()->Script($script, CMRecursos::POS_BODY);
?>
<script>
    $(function(){        
        $("#Categorias_cupo_maximo, #Categorias_cupo_minimo").on('change blur', function(){
            validarCupo();
        });
        
        $("#Categorias_edad_minima, #Categorias_edad_maxima").on('change blur', function(){
            validarEdad();
        });
    });
    function validarCupo(){
        var cmin = parseInt($("#Categorias_cupo_minimo").val());
        var cmax = parseInt($("#Categorias_cupo_maximo").val());
        if(cmin > cmax){
            $("#Categorias_cupo_maximo").val(cmin + cmin);
            mostrarAlerta("info", "El cupo mínimo no puede ser mayor al máximo, se subió al doble.");
            return true;
        } else if(cmin === cmax){
            mostrarAlerta("info", "¿Seguro desea que el cupo máximo y mínimo sean iguales?");
        }
        return false;
    }
    
    function validarEdad(){
        var emin = parseInt($("#Categorias_edad_minima").val());
        var emax = parseInt($("#Categorias_edad_maxima").val());
        if(emin > emax){
            $("#Categorias_edad_maxima").val(emin + 1);
            mostrarAlerta("warning", "La edad mínima no puede ser mayor a la máxima.");
            return true;
        } else if(emin === emax){
            $("#Categorias_edad_maxima").val(emin + 1);
            mostrarAlerta("error", "La edad máxima y la mínima no pueden ser iguales");
            return false;
        }
        return false;
    }
</script>