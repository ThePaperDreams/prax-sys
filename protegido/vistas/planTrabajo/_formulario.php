<?php 
$formulario = new CBForm(['id' => 'form-planestrabajo']);
$formulario->abrir();
?>
<div class="tile p-15">
    <p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Información del plan de trabajo
                </div>
                <div class="panel-body">
                    <?=  $formulario->inputAddon($modelo, 'fecha_aplicacion', 'text', ['class' => 'campo-fecha', 'label' => true, 'group' => true, 'autofocus' => true], ['pos' => CBoot::fa('calendar')]) ?>
                    <?=  $formulario->listaM($modelo, 'categoria_id', 'Categoria' ,'id_categoria', 'nombre', ['class' => 'campo-fecha', 'label' => true, 'group' => true, 'defecto' => 'Selecione una categoría']) ?>
                    <?=  $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true, 'rows' => 5]) ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Objetivos del plan de trabajo
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <?php $objetivos = CHtml::modeloLista(Objetivo::modelo()->listar(), "id_objetivo", "titulo"); ?>
                            <?= CBoot::select('', $objetivos, ['defecto' => 'Seleccione un objetivo', 'id' => 'lista-objetivos']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= CBoot::boton( CBoot::fa('plus-circle') . " Agregar ", 'default', ['class' => 'btn-block', 'id' => 'btn-agregar']) ?>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-objetivos">
                            <?php if(!$modelo->nuevo): ?>
                                <?php foreach($modelo->Detalles AS $detalle): ?>
                            <tr data-id="<?= $detalle->id_op ?>" data-obj="<?= $detalle->objetivo_id ?>">
                                <td><?= $detalle->Objetivo->titulo ?></td>
                                <td class="col-sm-1 text-center text-danger-icon"><i class="fa fa-ban" onclick="quitar($(this), true);" ></i></td>
                            </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="objetivos-eliminados"></div>
    <hr>

    <div class="row">
        <div class="col-sm-offset-3 col-sm-3">
            <?=  CHtml::link(CBoot::fa('undo').' Cancelar', ['planTrabajo/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
        </div>
        <div class="col-sm-3">
            <?=  CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['id' => 'btn-send', 'class' => 'btn-block']); ?>
        </div>
    </div>
</div>


<?php $formulario->cerrar(); ?>

<script>
    $(function(){
//        $("#PlanesTrabajo_fecha_aplicacion").datepicker({
//            dateFormat: 'yy-mm-dd'
//        });
        
        $("#btn-agregar").click(function(){
            if($("#lista-objetivos").val() !== ""){
                agregar();
            }
            return false;
        });
        $("#PlanesTrabajo_fecha_aplicacion").change(function(){
            validarFecha($(this));
        });
    });
    
    function validarFecha(fecha){
        var currDate = new Date();
        var date = Date.parse(fecha.val());
        if(date >= currDate){            
            $('#btn-send').removeAttr("disabled");
        } else {
            alert("Por favor seleccione una fecha mayor a la de hoy");
            $('#btn-send').attr("disabled", "disabled");
        }
    }
    
    function agregar(){
        var objetivo = $("#lista-objetivos").val();
        // validamos si ya se agregaron elementos con el id seleccionado
        if($("[data-obj='" + objetivo + "']").length > 0){ return; }        
        var objText = $("#lista-objetivos option:selected").text();
        var tdObj = $("<td/>").css('display', 'none').html(objText);
        var input = $("<input/>", {type: 'hidden', name:"objetivos[]"}).val(objetivo);
        var icon = $("<i/>", {class: 'fa fa-ban'}).click(function(){quitar($(this))});
        var tdOpc = $("<td/>", {class: 'col-sm-1 text-center text-danger-icon'})
                .css('display', 'none').append(input, icon);
        var tr = $("<tr>", {'data-obj':objetivo})
                .append(tdObj, tdOpc);
        $("#tabla-objetivos").append(tr);
        $("#lista-objetivos").focus();
        jQuery("[data-obj='" + objetivo + "'] td").fadeIn(800);
    }
    
    function quitar(obj, existente){
        var fila = obj.closest("tr");
        if(existente !== undefined){
            var id = fila.attr("data-id");
            var input = jQuery("<input>", {type:'hidden', name: "remover-objetivos[]"});
            input.val(id);
            jQuery("#objetivos-eliminados").append(input);
        }
        fila.find("td").fadeOut(800, function(){
            fila.remove();
        });       
    }
    
</script>