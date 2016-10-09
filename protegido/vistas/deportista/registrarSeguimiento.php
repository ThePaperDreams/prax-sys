<?php 
$this->tituloPagina = "Registrar seguimiento a "  . CHtml::e("strong", $deportista->nombreCompleto);

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
            <?= $formulario->inputAddon($modelo, 'evaluacion', 'number', ['label' => true, 'max' => 10, 'min' => 0, 'group' => true], ['pos' => '0-10']) ?>
            <?= $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>
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
                        <?= $seguimiento->descripcion ?>
                    </li>
                <?php endforeach ?>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane" id="negativos">
                <ul class="list-group" id="seg-negativos">
                <?php foreach($negativos AS $seguimiento): ?>
                    <li class="list-group-item">
                        <?= $seguimiento->descripcion ?>
                    </li>
                <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
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
                    var li = $("<li/>", {class: 'list-group-item'}).html(descripcion);
                    cont.prepend(li);
                } else {
                    console.log("Error al guardar el seguimiento");
                }
            }
        });
    }
</script>