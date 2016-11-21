<?php
$formulario = new CBForm(['id' => 'form-prestamosdeportista']);
$formulario->abrir();
?>
<div class="tile p-15">
    <div class="row">        
        <div class="col-sm-12">
            <div class="form-group">
                <label>Tipo de préstamo</label>
                <div class="form-group">        
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-gr-gray btn-sm <?= $entrada? '' : 'active' ?> btn-type">
                            <input type="radio" name="PrestamosDeportista[tipo_prestamo]" id="option1" <?= $entrada? '' : 'checked="true"' ?> value="salida"> Salida <i class="fa fa-arrow-circle-up"></i>
                        </label>
                        <label class="btn btn-gr-gray btn-type btn-sm  <?= $entrada? 'active' : '' ?> ">
                            <input type="radio" name="PrestamosDeportista[tipo_prestamo]" id="option2" <?= $entrada? 'checked="true"' : '' ?>  value="entrada"> Entrada <i class="fa fa-arrow-circle-down"></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <?php echo $formulario->lista($modelo, 'deportista_id', $deportistas, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un deportista', 'data-s2' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'club_origen', ['label' => true, 'group' => true, 'maxlength' => 80]) ?>        
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'club_destino', ['label' => true, 'group' => true, 'maxlength' => 80]) ?>        
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'fecha_inicio', ['label' => true, 'readonly' => true, 'group' => true, 'data-date' => true]) ?>                
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'fecha_fin', ['label' => true, 'readonly' => true, 'group' => true, 'data-date' => true]) ?>    
        </div>
        <div class="col-sm-12">
            <div class="row">
                <hr>
                <div class="col-sm-offset-6 col-sm-3">
                    <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['prestamoDeportista/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
                </div>
                <div class="col-sm-3">
                    <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
                </div>
            </div>            
        </div>
    </div>
</div>


<?php $formulario->cerrar(); ?>
<script>
    $(function(){
        $("#PrestamosDeportista_fecha_inicio").change(function(){
            var fecha1 = $(this);
            var fecha2 = $("#PrestamosDeportista_fecha_fin");
            if(fecha2.val() == ""){
                fecha2.val(fecha1.val());
            }          
            validarFechas();
        });

        $("#PrestamosDeportista_fecha_fin").change(function(){
            validarFechas();
        });
    });

    function validarFechas(){
        var fecha1 = $("#PrestamosDeportista_fecha_inicio"); 
        var fecha2 = $("#PrestamosDeportista_fecha_fin");
        var fechaIni = new Date(fecha1.val());
        var fechaFin = new Date(fecha2.val());

        if(fechaFin < fechaIni){
            lobiAlert("error", "La fecha final no puede ser menor a la inicial");
            $("#btn-send").attr("disabled", "disabled");
        } else {
            $("#btn-send").removeAttr("disabled");
        }

    }

    $(".btn-type").click(function(){
        $(".btn-type input").removeAttr("checked");
        $(this).find("input").attr("checked", "checked");
    });
</script>