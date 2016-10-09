<?php 
$formulario = new CBForm(['id' => 'form-equipos']);
$formulario->abrir();
?>
<div class="tile p-15">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#listar" aria-controls="listar" role="tab" data-toggle="tab">Información del Equipo</a></li>
        <li role="presentation"><a href="#cargar" aria-controls="cargar" role="tab" data-toggle="tab">Plantilla</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="listar">
            <?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
            <?php echo $formulario->campoNumber($modelo, 'cupo_maximo', ['label' => true, 'group' => true]) ?>
            <?php echo $formulario->campoNumber($modelo, 'cupo_minimo', ['label' => true, 'group' => true]) ?>
            <?php echo $formulario->campoTexto($modelo, 'estado', ['label' => true, 'group' => true]) ?>         
            <?php echo $formulario->campoTexto($modelo, 'posicion', ['label' => true, 'group' => true]) ?> 
            <?php echo $formulario->lista($modelo, 'torneo_id', $mTorneo, ['label'=> true,'defecto' => 'Seleccione el torneo en el participa el equipo']) ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="cargar">
            <div class="row" id="tab-imagenes">
                <?php echo $formulario->lista($modelo, 'entrenador_id', $Entre, ['label' => true, 'defecto' => 'Seleccione un entrenador']) ?>
                <br>
                <div class="col-sm-8">
                    <?php $jugadores = CHtml::modeloLista(Deportista::modelo()->listar(), "id_deportista", "nombre1"); ?>
                    <?= CBoot::select('', $jugadores, ['defecto' => 'Seleccione un jugador', 'id' => 'lista-deportistas']) ?>
                </div>    
                    <div class="col-sm-4">
                    <?= CBoot::boton( CBoot::fa('plus-circle') . " Agregar ", 'default', ['class' => 'btn-block', 'id' => 'btn-agregar']) ?>
                    </div>
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-deportistas">
                            <?php if(!$modelo->nuevo): ?>
                                <?php foreach($deportistas AS $d): ?>
                            <tr data-id="<?= $d->id_deportista ?>" data-obj="<?= $d->id_deportista ?>">
                                <td><?= $d->nombre1 ?></td>
                                <td class="col-sm-1 text-center text-danger-icon"><i class="fa fa-ban" onclick="quitar($(this), true);" ></i></td>
                            </tr>
                                <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                <div id="deportistas-eliminados">                
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-6 col-sm-3">
                <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['equipo/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
            </div>
            <div class="col-sm-3">
                <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
            </div>
        </div>
    </div>
</div>      

<?php $formulario->cerrar(); ?>

<script>
    $(function(){
        $("#form-equipos").submit(function(){
            validarNombre();
            return false;
        });
        $("#btn-agregar").click(function(){
            if($("#lista-deportistas").val() !== ""){
                agregar();
            }
            return false;
        });
    });
    
    function agregar(){
        var objetivo = $("#lista-deportistas").val();
        // validamos si ya se agregaron elementos con el id seleccionado
        if($("[data-obj='" + objetivo + "']").length > 0){ return; }        
        var objText = $("#lista-deportistas option:selected").text();
        var tdObj = $("<td/>").css('display', 'none').html(objText);
        var input = $("<input/>", {type: 'hidden', name:"jugadores[]"}).val(objetivo);
        var icon = $("<i/>", {class: 'fa fa-ban'}).click(function(){quitar($(this))});
        var tdOpc = $("<td/>", {class: 'col-sm-1 text-center text-danger-icon'})
                .css('display', 'none').append(input, icon);
        var tr = $("<tr>", {'data-obj':objetivo})
                .append(tdObj, tdOpc);
        $("#tabla-deportistas").append(tr);
        $("#lista-deportistas").focus();
        jQuery("[data-obj='" + objetivo + "'] td").fadeIn(800);
    }
    
    function quitar(obj, existente){
        var fila = obj.closest("tr");
        if(existente !== undefined){
            var id = fila.attr("data-id");
            var input = jQuery("<input>", {type:'hidden', name: "remover-deportistas[]"});
            input.val(id);
            jQuery("#deportistas-eliminados").append(input);
        }
        fila.find("td").fadeOut(800, function(){
            fila.remove();
        });       
    }
    
    function validarNombre() {
            var nombre = $("#Equipos_nombre").val();
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
                    if (respuesta.error == true) {
                        mostrarAlert("error", "Ya existe ese nombre");
                    } else {
                        document.getElementById("form-equipos").submit();
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
                delay: 8000,
                soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/',
            });
        }

    
</script>