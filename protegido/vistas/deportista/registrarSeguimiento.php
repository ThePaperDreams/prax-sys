<?php 
$this->tituloPagina = "Registrar seguimiento a "  . CHtml::e("strong", $deportista->nombreCompleto);
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar deportistas' => ['Deportista/inicio'],
    'Ficha técnica ' . $deportista->nombreCompleto => ['Deportista/fichaTecnica', 'id' => $deportista->id],
    'Añadir seguimientos',
];
?>
<div class="col-sm-5">
    <div class="tile p-15">
        <h4>Añadir seguimiento</h4>
        <?php 
            $formulario = new CBForm(['id' => 'form-seguimientos']);
            $formulario->abrir();
            ?>
            <label>Tipo de préstamo</label>
            <div class="form-group">        
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-gr-gray btn-sm active">
                        <input type="radio" name="Seguimientos[tipo_seguimiento]" id="option1" checked="true" value="0"> Positivo <i class="fa fa-plus"></i>
                    </label>
                    <label class="btn btn-gr-gray btn-sm">
                        <input type="radio" name="Seguimientos[tipo_seguimiento]" id="option2" value="1"> A mejorar <i class="fa fa-arrow-circle-down"></i>
                    </label>
                </div>
            </div>
            <?= $formulario->inputAddon($modelo, 'evaluacion', 'number', ['label' => true, 'max' => 10, 'min' => 0, 'group' => true, 'class' => 'solo-numeros maximo-numero'], ['pos' => '0-10']) ?>
            <div class="form-group">
                <label for="">Descripción <span id="total-chars">0</span>/<span id="max-chars">100</span> </label>
                <?= $formulario->areaTexto($modelo, 'descripcion', ['rows' => 6]) ?>
            </div>
            <?= CHtml::campoOculto($ficha->id_ficha_tecnica, null, ['id' => 'id_ficha_tecnica']) ?>

            <div class="row">
                <div class="col-sm-12">
                    <?= CBoot::boton(CBoot::fa('plus') .' '. 'Agregar', 'success', ['class' => 'btn-block', 'id' => 'btn-send']); ?>
                </div>
            </div>

        <?php $formulario->cerrar(); ?>
    </div>
</div>

<div class="col-sm-7">
    <div class="tile p-15">
        <h4>Seguimientos</h4>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#positivos" aria-controls="positivos" role="tab" data-toggle="tab">Positivos</a></li>
            <li role="presentation"><a href="#negativos" aria-controls="negativos" role="tab" data-toggle="tab">A mejorar</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="positivos">                
                <ul class="list-group" id="seg-positivos">
                <?php foreach($positivos AS $seguimiento): ?>
                    <li class="list-group-item">
                        <?= $seguimiento->descripcion ?> &nbsp;&nbsp;&nbsp;(<?= $seguimiento->evaluacion ?>)
                    </li>
                <?php endforeach ?>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane" id="negativos">
                <ul class="list-group" id="seg-negativos">
                <?php foreach($negativos AS $seguimiento): ?>
                    <li class="list-group-item">
                        <?= $seguimiento->descripcion ?> &nbsp;&nbsp;&nbsp;(<?= $seguimiento->evaluacion ?>)
                    </li>
                <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $("#Seguimientos_descripcion").keydown(function(e){
            var t = $(this);
            var max = parseInt($("#max-chars").html());
            $("#total-chars").html(t.val().length);
            if(t.val().length >= max && ( e.which != 8 && e.which !== 116)){
                e.preventDefault();
                return false;
            }
        });

        $("#form-seguimientos").submit(function(){            
            return false;            
        });
        $("#btn-send").click(function(){
            guardarSeguimiento();
        });
    });
    
    function guardarSeguimiento(){
        var evaluacion = $("#Seguimientos_evaluacion").val();
        var descripcion = $("#Seguimientos_descripcion").val();
        var ficha = $("#id_ficha_tecnica").val();
        var tipo = $("[name='Seguimientos[tipo_seguimiento]']:checked").val();

        if($.trim(evaluacion) == ""){
            lobiAlert("error", "Por favor ingrese una calificación");
            $("#Seguimientos_evaluacion").focus();
            return;
        } else if($.trim(descripcion) == ""){
            lobiAlert("error", "Por favor ingrese una descripción");
            $("#Seguimientos_descripcion").focus();
            return;
        }

        jQuery.ajax({
            'type' : 'POST',
            'url' : '<?= Sis::crearUrl(['deportista/seguimiento', 'id' => $deportista->id_deportista]) ?>',
            'data' : {
                ajx_snd: true,
                id_ficha_tecnica: ficha,
                evaluacion: evaluacion,
                descripcion: descripcion,
                tipo: tipo,
            },
            success: function(obj){
                if(obj.error === false){
                    $("#id_ficha_tecnica").val(obj.ficha);
                    var cont;
                    if(tipo == 0){
                        cont = $("#seg-positivos");
                    } else {
                        cont = $("#seg-negativos");
                    }
                    var li = $("<li/>", {class: 'list-group-item'}).html(descripcion + "&nbsp;&nbsp;&nbsp;(" + evaluacion + ")");
                    cont.prepend(li);
                    $("#Seguimientos_evaluacion").val("").focus();
                    $("#Seguimientos_descripcion").val("");
                } else {
                    console.log("Error al guardar el seguimiento");
                }
            }
        });
    }
</script>