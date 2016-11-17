<?php
$formulario = new CBForm(['id' => 'form-implementos']);
$formulario->abrir();
?>
<div class="tile p-15">
    <div class="row">
        <div class="col-sm-6">
            <?php echo $formulario->lista($modelo, 'categoria_id', $elementos, ['label' => true, 'group' => true, 'autofocus' => true, 'data-s2'  => true, 'defecto' => 'Selecciona una Categoría']) ?>
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'maxlength' => 50]) ?>            
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->campoNumber($modelo, 'unidades', ['max' => '300', 'label' => true, 'group' => true, 'min' => '0', 'class' => 'solo-numeros maximo-numero']) ?>
            <?php echo $formulario->campoNumber($modelo, 'minimo_unidades', ['max' => '300', 'label' => true, 'group' => true, 'min' => '0', 'class' => 'solo-numeros maximo-numero']) ?>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="">Descripción <span id="total-chars">0</span>/<span id="max-chars">500</span> </label>
                <?php echo $formulario->areaTexto($modelo, 'descripcion', ['rows' => 5]) ?>            
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-offset-6 col-sm-3">
            <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['implemento/inicio'], ['class' => 'btn btn-primary btn-block', 'id' => 'btn-send']); ?>
        </div>
        <div class="col-sm-3">
            <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block', 'id' => 'btnGuardar']); ?>
        </div>
    </div>

    <?php $formulario->cerrar(); ?>
</div>
<script>
    $(function () {
        $("#Implementos_descripcion").keydown(function(e){
            var t = $(this);
            var max = parseInt($("#max-chars").html());
            $("#total-chars").html(t.val().length);
            if(t.val().length >= max && ( e.which != 8 && e.which !== 116)){
                e.preventDefault();
                return false;
            }
        });
        $("#form-implementos").submit(function () {
            //if(maxMin()){
            if (maxMin() && implementos()) {
                validarNombre();
            }
            return false;
        });
    });

    function validarNombre() {
        var nombre = $("#Implementos_nombre").val();
        if (nombre === "") {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '<?= $url ?>',
            data: {
                validarNombre: true,
                nombre: nombre,
            },
            success: function (respuesta) {
                if (respuesta.error === true) {
                    mostrarAlert("error", "Ya existe ese nombre");
                } else {
                    document.getElementById("form-implementos").submit();

                }
            }
        });
    }

    function mostrarAlert(tipo, msg) {
        Lobibox.notify(tipo, {
            size: 'mini',
            showClass: 'bounceInRight',
            hideClass: 'bounceOutRight',
            msg: msg,
            delay: 5000,
            soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/',
        });
    }

    function maxMin() {
        var errores = true;
        var maximo = $('#Implementos_maximo_unidades').val();
        var current = $('#Implementos_unidades').val();
        var minimo = $('#Implementos_minimo_unidades').val();
        if (parseInt(minimo) > parseInt(maximo)) {
            mostrarAlert('error', 'Las Unidades Mínimas no pueden superar a las Unidades Máximas');
            errores = false;
        }
        if (parseInt(maximo) < parseInt(current)) {
            mostrarAlert('error', 'Las Unidades Máximas no pueden ser menores a las Unidades Disponibles');
            errores = false;
        }
        return errores;
    }

    function implementos() {
        var maximo = $('#Implementos_maximo_unidades').val();
        var current = $('#Implementos_unidades').val();
        var minimo = $('#Implementos_minimo_unidades').val();
        var errores = true;
        if (parseInt(current) <= 0 || current === "") {
            mostrarAlert('error', 'Las Unidades Disponibles deben tener un valor positivo');
            errores = false;
        }
        if (parseInt(minimo) <= 0 || minimo === "") {
            mostrarAlert('error', 'Las Unidades Mínimas deben tener un valor positivo');
            errores = false;
        }
        if (parseInt(maximo) <= 0 || maximo === "") {
            mostrarAlert('error', 'Las Unidades Máximas deben tener un valor positivo');
            errores = false;
        }
        return errores;
    }
</script>
