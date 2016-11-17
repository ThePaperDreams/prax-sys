<?php 
$formulario = new CBForm(['id' => 'form-planestrabajo']);
$formulario->abrir();
?>
<div class="tile p-15">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#formulario" aria-controls="formulario" role="tab" data-toggle="tab">Datos del plan</a></li>
        <li role="presentation"><a href="#objetivos" aria-controls="objetivos" role="tab" data-toggle="tab">Objetivos del plan</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="formulario">
            <p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6">
                    <?=  $formulario->inputAddon($modelo, 'fecha_aplicacion', 'text', ['class' => 'campo-fecha', 'label' => true, 'group' => true, 'autofocus' => true, 'readonly' => true], ['pos' => CBoot::fa('calendar')]) ?>
                </div>
                  <div class="col-sm-6">
                    <?=  $formulario->listaM($modelo, 'categoria_id', 'Categoria' ,'id_categoria', 'nombre', ['class' => 'campo-fecha', 'label' => true, 'group' => true, 'defecto' => 'Selecione una categoría','data-s2' => true]) ?>
                    <div class="form-group">
                        <label for="">Descripción <span id="total-chars">0</span>/<span id="max-chars">500</span> </label>
                        <?=  $formulario->areaTexto($modelo, 'descripcion', ['rows' => 5]) ?>
                    </div>
                      
                  </div>
              </div>
            </div>
            
        </div><!-- tab 1 -->
        
        <div role="tabpanel" class="tab-pane" id="objetivos">
            <div class="col-sm-12">
                <div class="alert alert-info">
                    Arrastra los objetivos de la derecha a la izquierda para agregarlos al plan de trabajo, y 
                    al revéz para eliminarlos.
                </div>
            </div>
            <div class="row" id="selec-objetivos">
                <div class="col-sm-6">
                    <h4>Objetivos agregados</h4>
                </div>
                <div class="col-sm-6">
                    <div id="filtros" class="form-group">
                        <?php 
                        $boton = CBoot::boton('Filtrar ' . CBoot::fa('filter'), 'default', ['id' => 'btn-filtrar-objetivos']); 
                        $boton1 = CHtml::link('Nuevo ' . CBoot::fa('plus'), '#', ['id' => 'btn-registrar-objetivos', 'class' => 'btn btn-default']);
                        ?>
                        <?= CBoot::textAddOn('', ['id' => 'filtro-obj-name', 'placeholder' => 'Filtrar objetivos', 'pos-btn' =>$boton.$boton1]) ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">                
                <ul id="objetivos-target" class="connectedSortable">
                    <?php if(!$modelo->nuevo): ?>
                        <?php foreach($modelo->Detalles AS $d): ?>
                    <li data-id="<?= $d->id_op ?>" data-old="true" data-obj-name="<?= strtolower($d->Objetivo->titulo) ?>"><?= $d->Objetivo->titulo ?></li>
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
            <div class="col-sm-6">
                <div class="row" id="form-reg-objetivo" style="display:none">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Registrar objetivo
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-info">
                                Ingrese los datos del nuevo objetivo
                                </div>
                                <?= CBoot::text('', ['id' => 'txt-obj-titulo', 'group' => true, 'label' => 'Título']) ?>
                                <?= CBoot::textArea('', ['id' => 'txt-obj-descripcion', 'group' => true, 'label' => 'Descripción']) ?>
                                <div class="row">
                                    <div class="col-sm-6">                                
                                      <?= CBoot::boton('Cancelar', 'primary', ['class' => 'btn-block', 'id' => 'btn-cancelar-obj']) ?>
                                    </div>
                                    <div class="col-sm-6">
                                      <?= CBoot::boton('Guardar objetivo', 'success', ['class' => 'btn-block', 'id' => 'btn-guardar-obj']) ?>
                                    </div>
                                </div>  
                            </div>
                        </div>                        
                    </div>
                </div>
                <ul id="objetivos-container" class="connectedSortable">
                <?php foreach($objetivos AS $obj): ?>
                    <li data-id="<?= $obj->id_objetivo ?>" data-obj-name="<?= strtolower($obj->titulo) ?>"><?= $obj->titulo ?></li>
                <?php endforeach ?>
                </ul>
            </div>
        </div><!-- tab 2 -->
    </div>    
    <div id="objetivos-eliminados"></div>
    <div id="objetivos-nuevos"></div>
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

        $("#PlanesTrabajo_descripcion").keydown(function(e){
            var t = $(this);
            var max = parseInt($("#max-chars").html());
            $("#total-chars").html(t.val().length);
            if(t.val().length >= max && ( e.which != 8 && e.which !== 116)){
                e.preventDefault();
                return false;
            }
        });

        $("#btn-send").click(function(){
            var total = $(".input-objetivo").length;
            if(total === 0){
                lobiAlert("error", "Por favor añada al menos un objetivo");
                return;
            }
        });
        $("#objetivos-container, #objetivos-target").sortable({
            connectWith: ".connectedSortable",
        }).disableSelection();
        
        $("#objetivos-target").on('sortreceive', function(e,i){
            var element = i.item;
            if(element.attr("data-old") !== undefined){
                removerHidden(element.attr("data-id"));
            } else {                
                agregarHidden(element.attr("data-id"));
            }
        });
        
        $("#btn-registrar-objetivos").click(function(){
            $("#filtros").slideUp();
            $("#objetivos-container").addClass('allow')
                    .slideUp(function(){                
                $("#form-reg-objetivo").slideDown(function(){
                    $("#txt-obj-titulo").focus();
                });
            });
            return false;
        });
        
        $("#btn-cancelar-obj").click(function(){
            cancelarObj();
            return false;
        });
        
        $("#btn-filtrar-objetivos").click(function(){
            filtrarObjetivos();
            return false;
        });
        
        $("#objetivos-container").on('sortreceive', function(e, i){
            var element = i.item;
            if(element.attr("data-old") !== undefined){
                var id = element.attr("data-id");
                // en caso de que ya esté en base de datos lo preparamos para ser eliminado
                var input = $("<input/>", {type: 'hidden', name:"remover-objetivos[]", id:"obj-" + id, class:"input-objetivo"}).val(id);
                $("#objetivos-eliminados").append(input);
            } else {                
                removerHidden(element.attr("data-id"));
            }
        });
        
        $("#btn-agregar").click(function(){
            if($("#lista-objetivos").val() !== ""){
                agregar();
            }
            return false;
        });
        $("#PlanesTrabajo_fecha_aplicacion").change(function(){
            validarFecha($(this));
        });
        $("#btn-guardar-obj").click(function(){
            guardarObjetivoAjx();
        });
    });
    
    function guardarObjetivoAjx(){
        var titulo = $("#txt-obj-titulo");
        var descripcion = $("#txt-obj-descripcion");
        if($.trim(titulo.val()) === ""){
            lobiAlert('error', 'Por favor ingrese un título para el objetivo');
            $("#txt-obj-titulo").focus();
            return;
        }
        $.ajax({
            type: 'POST',
            url: '<?= Sis::apl()->urlActual() ?>',
            data: {
                ajxrqst:true,
                titulo: titulo.val(),
                descripcion: descripcion.val()
            },
            success: function(obj){
                if(obj.error === false){
                    lobiAlert(obj.tipo, obj.msg);
                    titulo.val("");
                    descripcion.val("");
                    agregarNuevoObjetivo(obj);
                    cancelarObj();
                } else if(obj.error === true){
                    lobiAlert(obj.tipo, obj.msg);
                }else {
                    console.log(obj);
                    lobiAlert('error', 'ocurrió un error inesperado');
                }
            }
        });
    }
    
    function agregarNuevoObjetivo(obj){
        var li = $("<li/>", {"data-id" : obj.id, 'data-name' : obj.titulo});
        li.text(obj.titulo);
        $("#objetivos-container").prepend(li);
    }
    
    function cancelarObj(){
        var cont = $("#objetivos-container");
        cont.removeClass("allow");
        $("#form-reg-objetivo").slideUp(function(){
            $("#filtros").slideDown();
            cont.slideDown();
        });
    }
    
    function filtrarObjetivos(){
        var txt = $("#filtro-obj-name");
        var objs = $("#objetivos-container > [data-obj-name]");
        objs.css('display', 'none');
        if($.trim(txt.val()) === ""){
            objs.css('display', 'inherit');
            return;
        }        
        $("#objetivos-container > [data-obj-name*='" + txt.val().toLowerCase() + "']").css('display', 'inherit');
        
    }
    
    function validarFecha(fecha){
        var d = new Date();
        var fechaActualStr = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + (d.getDate() < 10? '0' : '') + d.getDate();
        var currDate = Date.parse(fechaActualStr);
        var date = Date.parse(fecha.val());

        if (date  > currDate) {
            $('#btn-send').removeAttr("disabled");
        } else {
            lobiAlert("error", "Seleccione una fecha mayor a la de hoy");
            $('#btn-send').attr("disabled", "disabled");
        }
    }
    
    function agregarHidden(id){
        var input = $("<input/>", {type: 'hidden', name:"objetivos[]", id:"obj-" + id, class: 'input-objetivo'}).val(id);
        $("#objetivos-nuevos").append(input);
    }
    
    function removerHidden(id){
        var input = $("#obj-" + id);
        input.remove();
    }
    
    function agregar(){
        var objetivo = $("#lista-objetivos").val();
        // validamos si ya se agregaron elementos con el id seleccionado
        if($("[data-obj='" + objetivo + "']").length > 0){ return; }        
        var objText = $("#lista-objetivos option:selected").text();
        var tdObj = $("<td/>").css('display', 'none').html(objText);
        var input = $("<input/>", {type: 'hidden', name:"objetivos[]"}).val(objetivo);
        var icon = $("<i/>", {class: 'fa fa-trash'}).click(function(){quitar($(this))});
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
            var input = jQuery("<input>", {type:'hidden', name: "remover-objetivos[]", class:"input-objetivo"});
            input.val(id);
            jQuery("#objetivos-eliminados").append(input);
        }
        fila.find("td").fadeOut(800, function(){
            fila.remove();
        });       
    }
    
</script>