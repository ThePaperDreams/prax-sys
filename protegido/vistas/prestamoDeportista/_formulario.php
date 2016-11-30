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
                    <?= CBoot::select('', ['Seleccione un tipo de préstamo', 'entrada' => 'Entrada', 'salida' => 'Salida'], ['id' => 'tipo-prestamo', 'name' => 'PrestamosDeportista[tipo_prestamo]']) ?>
<!--                     <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-gr-gray btn-sm <?= $entrada? '' : 'active' ?> btn-type">
                            <input type="radio" name="PrestamosDeportista[tipo_prestamo]" id="option1" <?= $entrada? '' : 'checked="true"' ?> value="salida"> Salida <i class="fa fa-arrow-circle-up"></i>
                        </label>
                        <label class="btn btn-gr-gray btn-type btn-sm  <?= $entrada? 'active' : '' ?> ">
                            <input type="radio" name="PrestamosDeportista[tipo_prestamo]" id="option2" <?= $entrada? 'checked="true"' : '' ?>  value="entrada"> Entrada <i class="fa fa-arrow-circle-down"></i>
                        </label>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="">Club de origen</label>
                <?php echo $formulario->lista($modelo, 'club_origen', $clubes, ['defecto' => 'Seleccione un club de destino', 'data-s2' => true]) ?>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="">Club destino</label>
                <?php echo $formulario->lista($modelo, 'club_destino', $clubes, ['defecto' => 'Seleccione un club de destino', 'data-s2' => true]) ?>
            </div>
        </div>
        <div class="col-sm-12">
            <?php echo $formulario->lista($modelo, 'deportista_id', $deportistas, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un deportista', 'data-s2' => true]) ?>
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

<input type="hidden" id="input-switch">

<?php $formulario->cerrar(); ?>
<script>
    var club_principal = '<?= Configuracion::get("club_principal") ?>';
    $(function(){

        $("#tipo-prestamo").change(function(){
            consultarDeportista($(this).val());
            // Este es el input que manejará el valor del club de origen o destino
            var inputSwitch = $("#input-switch");

            if($(this).val() == "entrada"){
                var selectM = $("#PrestamosDeportista_club_origen");
                var selectM1 = $("#PrestamosDeportista_club_destino");
                inputSwitch.attr("name", "PrestamosDeportista[club_destino]");
            } else if($(this).val() == "salida"){
                var selectM = $("#PrestamosDeportista_club_destino");
                var selectM1 = $("#PrestamosDeportista_club_origen");
                inputSwitch.attr("name", "PrestamosDeportista[club_origen]");
            }

            selectM1.select2("destroy");
            selectM1.val(club_principal);
            selectM1.select2({width: '100%'});
            selectM1.select2("enable", false);
            inputSwitch.val(selectM1.val());

            selectM.select2("enable", true);
            selectM.select2("open");

        });

        $("#PrestamosDeportista_deportista_id").select2("enable", false);

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

    function consultarDeportista(tipo){
        $.ajax({
            type    : 'POST',
            url     : '<?= Sis::crearUrl(['prestamoDeportista/ajax']) ?>',
            data    : {
                tipo : tipo,
                ajax : true,
            }
        }).done(function(data){ 
            if(data.error == false){
                var select = $("#PrestamosDeportista_deportista_id");
                select.select2("destroy");
                select.html(data.opciones);
                select.select2({
                    width: '100%',
                });
                select.select2("enable", true)
                // select.select2("open");
            } else {
                lobiAlert("error", "Ocurrió un error");
            }
        });
    }

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