<?php 
$formulario = new CBForm(['id' => 'form-asistencia']);
$formulario->abrir();
?>
<div class="tile p-15">
    <div class="panel panel-default">
        <div class="panel-heading">
            Toma de asistencia
        </div>
        <div class="panel panel-body">
            <div class="col-sm-6">
                <?= $formulario->inputAddon($modelo, 'fecha', 'text', [ 'readonly' => true, 'label' => true, 'group' => true, 'autofocus' => true, 'data-date' => true], ['pos' => CBoot::fa('calendar')]) ?>
                <?= $formulario->listaM($modelo, 'categoria_id', 'Categoria', 'id_categoria', 'nombre', ['label' => true, 'group' => true, 'defecto' => 'Seleccione una categoría', 'data-s2' => true]) ?>
            </div>
            <div class="col-sm-6">
                <label for="">Novedad <span id="total-chars">0</span>/<span id="max-chars">500</span> </label>
                <?= $formulario->areaTexto($modelo, 'novedad', ['group' => true, 'rows' => 5]) ?>
            </div>
            <hr>
            <div class="col-sm-12">
                <h4>Deportistas</h4>
                <div id="lista-deportistas">
                    <table class="table table-hover" id="tabla-deportistas">
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th class="text-center col-sm-2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>            
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-offset-6 col-sm-3">
                    <?= CHtml::link(CBoot::fa('undo').' Cancelar', ['asistencia/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
                </div>
                <div class="col-sm-3">
                    <?= CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
                </div>
            </div>        
        </div>
    </div>
</div>
<?php $formulario->cerrar(); ?>

<script>
    $(function(){

        $("#Asistencia_novedad").keydown(function(e){
            var t = $(this);
            var max = parseInt($("#max-chars").html());
            $("#total-chars").html(t.val().length);
            if(t.val().length >= max && ( e.which != 8 && e.which !== 116)){
                e.preventDefault();
                return false;
            }
        });

        // validamos que si se hayan listado deportistas
        $("#form-asistencia").submit(function(){
            if($("[data-matricula]").length == 0){
                Lobibox.notify("error",{
                    size: 'mini',
                    showClass: 'bounceInRight',
                    hideClass: 'bounceOutRight',
                    msg: "Debe haber deportistas matriculados en la categoría seleccionada para poder tomar asistencia",
                    delay: 8000,
                    soundPath: '<?= Sis::Recursos()->getUrlRecursos() ?>librerias/lobibox/sounds/',
                });
                return false;
            }
            return true;
        });
        $("#Asistencia_categoria_id").change(function(){
            doAjax({
                id: jQuery(this).val(),
                r:'asistencia-listar'
            }, listarDeportistas);
        });
    });
    
    function listarDeportistas(obj){
        $("#tabla-deportistas tbody").html(obj.html);
    }
    
    function doAjax(data, callback){
        data.ajx = true;
        $.ajax({
            'type' : 'POST',
            'url' : '<?= Sis::CrearUrl(['asistencia/ajx']) ?>',
            'data' : data,
            'success': function(r){
                callback(r);
            },
        });
    }
    
    function toggleOp(op){
        var on = op.attr("data-on") !== undefined;
        var tr = op.closest("tr");

        if(on){
            op.removeAttr("data-on");
            tr.removeClass("danger");
            op.removeClass("btn-danger").addClass("btn-default");
            op.find("span.txt").text("Asistió");
        } else {
            op.attr("data-on", "true");
            tr.addClass("danger");
            op.removeClass("btn-default").addClass("btn-danger");
            op.find("span.txt").text("No asistió");
        }
    }
</script>