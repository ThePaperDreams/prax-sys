<?php 
Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput_locale_es.js']);

$formulario = new CBForm(['id' => 'form-torneos', 'opcionesHtml' =>['enctype' => 'multipart/form-data']]);
$formulario->abrir();
?>
<div class="tile p-15">
<div class="row">
    <div class="col-sm-6">    
        <?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true, 'maxlength' => 50]) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->inputAddon($modelo, 'edad_maxima', 'number', ['label' => true, 'group' => true, 'min'=> 5, 'max'=> 16,  'class' => 'solo-numeros dont-overpass'], ['pos' => 'Max: 16']) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">    
        <?php echo $formulario->inputAddon($modelo, 'cupo_minimo', 'number', ['label' => true, 'group' => true, 'min'=> 1, 'id'=>'cant', 'class' => 'solo-numeros dont-overpass', 'max' => '4'], ['pos' => 'Max: 4']) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->inputAddon($modelo, 'cupo_maximo', 'number', ['label' => true, 'group' => true,' min'=> 1, 'max' => '4', 'id'=>'total-unidades', 'class' => 'solo-numeros dont-overpass'], ['pos' => 'Max: 4']) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->inputAddon($modelo, 'fecha_inicio', 'texto', ['data-val-maxmin' => true, 'label' => true, 'group' => true, 'class' => 'campo-fecha', 'readonly' => true], ['pos-btn' => CBoot::boton(CBoot::fa('eraser'), 'primary', ['class' => 'clean-field', 'data-t' => '#Torneos_fecha_inicio']), 'pos' => CBoot::fa('calendar', ['class' => 't-calendar', 'data-t' => '#Torneos_fecha_inicio'])]) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->inputAddon($modelo, 'fecha_fin', 'texto', ['data-val-maxmin' => true, 'label' => true, 'group' => true, 'class' => 'campo-fecha', 'readonly' => true],['pos-btn' => CBoot::boton(CBoot::fa('eraser'), 'primary', ['class' => 'clean-field', 'data-t' => '#Torneos_fecha_fin']), 'pos' => CBoot::fa('calendar-check-o', ['class' => 't-calendar', 'data-t' => '#Torneos_fecha_fin'])]) ?> 
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->campoArchivo($modelo, 'tabla_posiciones', ['label' => true, 'group' => true]) ?>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Observaciones <span id="total-chars">0</span>/<span id="max-chars">500</span> </label>
            <?php echo $formulario->areaTexto($modelo, 'observaciones', ['rows' => 8]) ?> 
        </div>
    </div>
</div>    
    <div class="row">
        <div class="col-sm-offset-6 col-sm-3">
            <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['torneo/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
        </div>
        <div class="col-sm-3">
            <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block' ]); ?>
        </div>
    </div>
</div>
<script>
  $(document).ready(function() {
    $("#Torneos_edad_maxima").blur(function(){
        var valor = parseInt($(this).val());
        var min = parseInt($(this).attr("min"));
        console.log(valor, min);
        if(isNaN(valor) || valor < min){
            lobiAlert("error", "La edad debe ser mayor a " + min + " años");
            $(this).val(min);
        }
    });

    $("#cant").blur(function(){
        var cupo_min = $("#cant");
        var cupo_max = $("#total-unidades");
        var max = parseInt(cupo_max.val()), min = parseInt(cupo_min.val());
        if(min > max){
            lobiAlert("error", "El cupo mínimo debe ser menor o igual al cupo máximo");
            $(this).val(max);
        }

        if(min == 0){
            lobiAlert("error", "El cupo mínimo debe ser mayor o igual a 1");
            $(this).val(1);
        }
    });

    $("#form-torneos").submit(function(){
        var cupo_min = $("#cant");
        var cupo_max = $("#total-unidades");
        var max = parseInt(cupo_max.val()), min = parseInt(cupo_min.val());
        if(min > max){
            lobiAlert("error", "El cupo mínimo debe ser menor al cupo máximo");
            return false;
        }

        if(min == 0){
            lobiAlert("error", "El cupo mínimo debe ser mayor o igual a 1");
            cupo_min.val(1);
        }
    });

    $("#total-unidades").blur(function(){
        var min = parseInt($("#cant").val());
        var max = parseInt($(this).val());
        if(max < min){
            $(this).val(min);
            lobiAlert("error", "Cupo máximo no puede ser menor al cupo mínimo");
        }
    });

    $("#Torneos_tabla_posiciones").fileinput({ // Para embellecer el file input de la foto
        showPreview: false,
        showRemove: false,
        showUpload: false,
        browseLabel: "Seleccionar archivo",
        maxFileSize: 5000,
        allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg'],
        language: 'es',
    });    

    $("#Torneos_observaciones").keydown(function(e){
        var t = $(this);
        var max = parseInt($("#max-chars").html());
        $("#total-chars").html(t.val().length);
        if(t.val().length >= max && ( e.which != 8 && e.which !== 116)){
            e.preventDefault();
            return false;
        }
    });

    $("#cant").keyup(function(){
        var limite = parseInt($("#total-unidades").html());
        if($(this).val() > limite){
            lobiAlert("error", "No puede ingresar una cantidad mayor a las unidades actuales");
            var cant = $(this);
            cant.val(limite);
            }
        });      
        $("#Torneos_fecha_inicio, #Torneos_fecha_fin").change(function(){
            validarFechas();
        });
        // var f1 = $("#Torneos_fecha_inicio");
        // var f2 = $("#Torneos_fecha_fin");
    });

    function validarFechas(){
        var f1 = $("#Torneos_fecha_inicio");
        var f2 = $("#Torneos_fecha_fin");

        var fecha1 = Date.parse(f1.val());
        var fecha2 = Date.parse(f2.val());

        if(fecha1 > fecha2){
            lobiAlert("error", "La fecha inicial no puede ser mayor a la final");
            f2.val(f1.val());
        }

    }
 </script>

<?php $formulario->cerrar(); ?>