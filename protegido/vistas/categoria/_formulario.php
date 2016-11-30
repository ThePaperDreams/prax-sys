<?php 
$formulario = new CBForm(['id' => 'form-categorias']);
$formulario->abrir();
?>
<div class="tile p-15">
    <p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
    <hr>    
    <div class="row">
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true, 'maxlength' => 30]) ?>
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->inputAddon($modelo, 'tarifa', 'number', ['label' => true, 'class' => 'text-right solo-numeros maximo-numero r-trim-zero', 'min' => 0, 'max' => 100000, 'group' => true], ['pre' => CBoot::fa('dollar')]) ?>
        </div>
    </div>
    <?php echo $formulario->lista($modelo, 'entrenador_id', $entrenadores, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un entrenador', 'data-s2' => true]) ?>
    <div class="form-group">
        <label for="">Descripción <span id="total-chars">0</span>/<span id="max-chars">500</span> </label>
        <?php echo $formulario->areaTexto($modelo, 'descripcion', ['class' => '', 'rows' => 8]) ?>        
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?php echo $formulario->campoNumber($modelo, 'cupo_minimo', ['label' => true, 'max' => 30, 'class' => 'dont-overpass text-right solo-numeros', 'group' => true, 'min' => 0]) ?>
        </div>
        <div class="col-sm-3">
            <?php echo $formulario->campoNumber($modelo, 'cupo_maximo', ['label' => true, 'max' => 30, 'class' => 'dont-overpass text-right solo-numeros', 'group' => true, 'min' => 0]) ?>        
        </div>
        <div class="col-sm-3">
            <?php echo $formulario->campoNumber($modelo, 'edad_minima', ['label' => true, 'max' => 16, 'min' => 6, 'class' => 'over-minimum     dont-overpass text-right solo-numeros', 'group' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?php echo $formulario->campoNumber($modelo, 'edad_maxima', ['label' => true, 'max' => 16, 'min' => 6, 'class' => 'over-minimum     dont-overpass text-right solo-numeros', 'group' => true]) ?>
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

                            . 'var cupoMin = $("#Categorias_cupo_minimo");' 
                            . 'var cupoMax = $("#Categorias_cupo_max");' 
                            . 'var edadMin = $("#Categorias_edad_minima");' 
                            . 'var edadMax = $("#Categorias_edad_maxima");' 
                            . 'var enviar = true;' 
                            . 'var msg = "";' 
                            . 'if(cupoMin.val() == \'0\'){ msg = "Cupo mínimo no puede ser cero"; enviar = false; } ' 
                            . 'else if(cupoMax.val() == \'0\'){ msg = "Cupo mínimo no puede ser cero"; enviar = false; }' 
                            . 'else if(edadMin.val() == \'0\'){ msg = "Cupo mínimo no puede ser cero"; enviar = false; }' 
                            . 'else if(edadMax.val() == \'0\'){ msg = "Cupo mínimo no puede ser cero"; enviar = false; }'             
                            . 'if(enviar == false){lobiAlert("error", msg);}' 
                            . 'else {document.getElementById("form-categorias").submit();}'
                        . '}'
                    . '},'
                . '});'
            . '}'
            . 'function mostrarAlerta(tipo, msg){'
                . 'lobiAlert(tipo, msg);' 
                // . 'Lobibox.notify(tipo,{'
                //     . 'size:"mini",'
                //     . 'showClass:"bounceInRight",'
                //     . 'hideClass:"bounceOutRight",'
                //     . 'msg:msg,'
                //     . 'delay:8000,'
                //     . 'soundPath:"' . Sis::UrlRecursos() . 'librerias/lobibox/sounds/",'
                // . '});'
            . '}';
    Sis::Recursos()->Script($script, CMRecursos::POS_BODY);
?>
<script>
    $(function(){        
        $("#Categorias_tarifa").blur(function(){
            if($.trim($(this).val()) == ''){ $(this).val(0); }
        });

        // $("#form-categorias").submit(function(){

        // });

        $("#Categorias_descripcion").keydown(function(e){
            var t = $(this);
            var max = parseInt($("#max-chars").html());
            $("#total-chars").html(t.val().length);
            if(t.val().length >= max && ( e.which != 8 && e.which !== 116)){
                e.preventDefault();
                return false;
            }
        });

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
            $("#Categorias_cupo_maximo").val(cmin);
            // mostrarAlerta("info", "El cupo mínimo no puede ser mayor al máximo, se subió al doble.");
            return true;
        } else if(cmin === cmax){
            mostrarAlerta("info", "¿Seguro desea que el cupo máximo y mínimo sean iguales?");
        }
        return false;
    }
    
    function validarEdad(){
        var emin = parseInt($("#Categorias_edad_minima").val());
        var emax = parseInt($("#Categorias_edad_maxima").val());
        var eAge = emin + 1;
        if(eAge > 16){ eAge = 16; }
        if(emin > emax){
            $("#Categorias_edad_maxima").val(eAge);
            mostrarAlerta("warning", "La edad mínima no puede ser mayor a la máxima.");
            return true;
        } 
        // else if(emin === emax){
        //     $("#Categorias_edad_maxima").val(emin + 1);
        //     mostrarAlerta("error", "La edad máxima y la mínima no pueden ser iguales");
        //     return false;
        // }
        return false;
    }
</script>