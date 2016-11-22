<?php 
$this->tituloPagina = "Gestionar equipos de: Torneo " . $torneo->nombre;
$this->migas = [
    'Listar torneos' => ['torneo/inicio'],
    'Ver torneo' => ['torneo/ver', 'id' => $this->_g['id']],
    'Gestionar equipos',
];

Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/customScrollBar/CustomScrollbar.js']);
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . 'librerias/customScrollBar/CustomScrollbar.css']);
?>
<div class="col-sm-6">
    <form method="POST" id="form-equipos">

        <input type="hidden" id="edad-maxima-torneo" value="<?= $torneo->edad_maxima ?>">
        <input type="hidden" id="cupo-maximo-torneo" value="<?= $torneo->cupo_maximo ?>">
        <input type="hidden" id="cupo-maximo-torneo" value="<?= $torneo->cupo_minimo ?>">

        <div class="tile p-15">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="p-15"></div>
                        <div class="row">
                            <div class="alert alert-info">
                                <table class="table table-condensed">
                                    <tr>
                                        <td>Edad máxima de jugadores: </td>
                                        <td><?= $torneo->edad_maxima ?> años</td>
                                    </tr>
                                    <tr>
                                        <td>Máximo equipos: </td>
                                        <td><?= $torneo->cupo_maximo ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row" id="buttons-options">
                            <div class="col-sm-4">
                                <a href="<?= Sis::apl()->crearUrl(['torneo/inicio']) ?>" class="btn btn-default btn-block">Cancelar </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="#" id="btn-show-form" class="btn btn-primary btn-block">Agregar equipo <i class="fa fa-plus"></i></a>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-success btn-block" id="finish-editing">Terminar <i class="fa fa-send"></i></button>
                            </div>
                        </div>
                        <div id="form-team" style="display:none;">

                            <div class="row">                        
                                <div class="col-sm-12">
                                    <?= CBoot::text('', ['group' => true, 'label' => 'Nombre', 'id' => 'nombre']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= CBoot::select('', $usuarios, ['group' => true, 'label' => 'Entrenador', 'defecto' => 'Seleccione un entrenador', 'id' => 'entrenador']) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= CBoot::number('', ['group' => true, 'label' => 'Máximo de Jugadores', 'min' => '1', 'id' => 'cupo-max']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button id="cancel-team" class="btn btn-default btn-block">Cerrar</button>
                                </div>
                                <div class="col-sm-6">
                                    <button id="add-team" class="btn btn-success btn-block">Agregar <?= CBoot::fa('plus') ?></button>
                                </div>
                            </div>

                        </div>
                    </div>                
                </div>
                <div class="p-15">
                    <hr>
                    <h3>Equipos</h3>
                    <hr>
                    <div class="p-15"></div>
                    <div id="contenedor-equipos"  class="contenedor-equipos">
                        <?php $deportistas = []; ?>
                        <?php foreach($torneo->Equipos AS $equipo): ?>
                        <div id="div-<?= $equipo->id_equipo ?>" data-id-equipo="<?= $equipo->id_equipo ?>" data-team-name="<?= $equipo->nombre ?>" class="equipo panel panel-primary" data-ant="true" data-min="0" data-max="<?= $equipo->cupo_maximo ?>" data-act="<?= $equipo->TotalJugadores ?>">
                            <div class="panel-heading"><?= $equipo->nombre ?> 
                                <span class="label-<?= $equipo->TotalJugadores < intval($equipo->cupo_maximo)? 'danger' : 'success' ?>"><i class=""><?= $equipo->TotalJugadores ?></i> - <?= $equipo->cupo_maximo ?></span> 
                                <i class="fa fa-trash remove-equipo" onclick="removerEquipoAnt('<?= $equipo->id_equipo ?>')"></i>
                            </div>
                            <div id="equipo-<?= $equipo->id_equipo ?>" data-old="true" class="panel-body panel-receptor equipos-antiguos">
                                <input type="hidden" class="input-team" name="equipos[<?= $equipo->id_equipo ?>][editar]" value="true" disabled="disabled">
                                <input type="hidden" class="input-team" name="equipos[<?= $equipo->id_equipo ?>][nombre]" value="<?= $equipo->nombre ?>" disabled="disabled">
                                <input type="hidden" class="input-team" name="equipos[<?= $equipo->id_equipo ?>][entrenador]" value="<?= $equipo->entrenador_id ?>" disabled="disabled">
                                <input type="hidden" class="input-team" name="equipos[<?= $equipo->id_equipo ?>][cupo-max]" value="<?= $equipo->cupo_maximo ?>" disabled="disabled">
                                <input type="hidden" class="input-team" name="equipos[<?= $equipo->id_equipo ?>][cupo-min]" value="<?= $equipo->cupo_minimo ?>" disabled="disabled">
                                
                                <ul class="receptor-jugadores sorteable" data-equipo="<?= $equipo->id_equipo ?>">
                                    <?php foreach($equipo->JugadoresE AS $jugador): ?>
                                    <?php $deportistas[] = $jugador->Deportista->id_deportista ?>
                                    <?= $this->vistaP('_itemDeportista', ['deportista' => $jugador->Deportista]) ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                        <?php endforeach ?>
                        <?php 
//                        var_dump($deportistas); exit();
                        ?>
                    </div>
                </div>
            </div>
        </div> 
        <div id="equipos-remover">
    
        </div>
        <div id="jugadores-remover">

        </div>
    </form>    
</div>       
<div class="col-sm-6">
    <div class="tile p-15">
        <div class="row p-15">
            <h3>Jugadores</h3>
            <div class="alert alert-info">
                Seleccione la categoría en la cual desea buscar jugadores. Una vez seleccionada la categoría puede 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            <div id="filtros-deportista">
                <?= CBoot::select('', $categorias, ['id' => 'cmb-categoria', 'defecto' => 'Seleccione una categoría', 'data-s2' => true, 'group' => true]) ?>
                <?= CBoot::text('',['placeholder' => 'Ingrese el nombre del deportista']) ?>                
            </div>
            <hr>
            <div class="contenedor-jugadores">
                <ul id="listado-deportistas" class="listado-deportistas sorteable">

                </ul>
            </div>
        </div>
    </div>    
</div>     

<script>
    var equipos = 0;
    var jugadoresRemovidos = 0;
    
    $(function(){
        $("#form-equipos").submit(function(){ return false; });
        $("#finish-editing").click(function(){
            $(this).attr("disabled", "disabled");
            document.getElementById("form-equipos").submit();
        });
        
        $(".equipos-antiguos").find("li").each(function(k, v){
            var li = $(v);
            var ul = li.closest("ul");
            var id = ul.attr("data-equipo");
            li.attr("data-contenedor", "div-" + id);
        });
        
        $(".equipos-antiguos ul").sortable({
            connectWith: '.listado-deportistas',
            helper: 'clone',
            appendTo: 'body',
            zIndex: 10000,
        }).disableSelection();
        
        $(".equipos-antiguos ul").on('sortreceive', function(e, i){
            var equipo = $(this).attr("data-equipo");
            if(addDeportista(e, i, equipo)){
                // lobiAlert("error", "No puede agregar más jugadores a este equipo");
                i.sender.sortable('cancel');
            }
        });
        
        $(".listado-deportistas").sortable({
            connectWith: '.sorteable',
            helper: 'clone',
            appendTo: 'body',
            zIndex: 10000
        }).disableSelection();
        
        $(".listado-deportistas").on('sortreceive', function(e, i){
            removerDeportista(e, i);
        });
        
        $("#add-team").click(function(){
            agregarEquipo();
        });
        $("#cmb-categoria").change(function(){
            consultarJugadores($(this).val());
        });
        $(".equipos-antiguos").mCustomScrollbar({
           theme: "rounded-dots", 
        });
        $(".contenedor-jugadores").mCustomScrollbar({
           theme: "rounded-dots", 
        });
        
        $("#cancel-team").click(function(){
            $("#form-team").slideUp(function(){
                $("#buttons-options").slideDown();
            });
        });
        
        $("#btn-show-form").click(function(){
            $(this).closest(".row").slideUp(function(){
                $("#form-team").slideDown(function(){
                    $("#nombre").focus();
                });
            });
        });
    });
    
    var equiposRemovidos = 0;
    
    function removerEquipoAnt(id){
        if(!confirm("¿Seguro que desea remover este equipo?")){
            return;
        }
        
        var div = $("#div-" + id);
        
        div.slideUp(function(){
            var input = $("<input/>", { type: 'hidden', name : 'equipos-remover[]'});
            input.val(id);
            div.remove();
            $("#equipos-remover").append(input);
            equiposRemovidos ++;
        });
    }
    
    var deportistas = [<?= implode(',', array_map(function($v){ return "'$v'"; }, $deportistas)) ?>];
    
    function consultarJugadores(id){
        $.ajax({
            'type' : 'POST',
            'url' : '<?= Sis::CrearUrl(['torneo/ajx']) ?>',
            'data' : {
                'ajx' : true,
                'id' : id,
                'deportistas' : deportistas,
            },
            'success' : function (obj){
                $("#listado-deportistas").html(obj.html);
            },
        });
    }
    
    var nombresEquipos = {
    
    };
    
    function agregarEquipo(){
        var maximoEquipos = parseInt($("#cupo-maximo-torneo").val());
        var totalEquipos = $("[data-team-name]").length;
        if(totalEquipos >= maximoEquipos){
            lobiAlert('error', "No puede agregar más equipos para este torneo");
            return false;
        }

        var nombre = $("#nombre");
        var entrenador = $("#entrenador");
        var cupoMin = 0;
        var cupoMax = $("#cupo-max");
        var error = function(msg){ lobiAlert('error', msg); };
        var vc = function(campo, n) {
            if($.trim(campo.val()) === ""){ error(n + " no puede ser vacio."); campo.focus(); return true; }
            else { return false; }            
        };
        
        
        if(vc(nombre, 'Nombre')){ return false; }
        else if(vc(entrenador, 'Entrenador')) {return false;}
        else if(vc(cupoMax, 'Cupo máximo')){ return false;}
        
        var nombreTexto = nombre.val();
        var totalMismoNombre = $("[data-team-name='" + nombre.val() + "']").length;        
        // Validamos si ya hay un equipo con ese nombre
        if(totalMismoNombre > 0){
            if(nombresEquipos[nombreTexto] !== undefined){
                nombresEquipos[nombreTexto] ++;
            } else {
                nombresEquipos[nombreTexto] = 1;
            }
            nombreTexto = nombreTexto + " (" + nombresEquipos[nombreTexto] + ")";
            console.log(nombresEquipos);
        }
        
        var hiddens = '<input type="hidden" name="equipos[' + equipos + '][nombre]" value="' + nombreTexto + '">';
        hiddens += '<input type="hidden" name="equipos[' + equipos + '][entrenador]" value="' + entrenador.val() + '">';
        hiddens += '<input type="hidden" name="equipos[' + equipos + '][cupo-max]" value="' + cupoMax.val() + '">';
        hiddens += '<input type="hidden" name="equipos[' + equipos + '][cupo-min]" value="' + cupoMin + '">';
        
        var html = '<div data-team-name="' + nombre.val() + '" id="div-' + equipos + '" class="equipo panel panel-primary" data-min="' + cupoMin + '" data-max="' + cupoMax.val() + '" data-act="0">' +
                        '<div class="panel-heading">' + nombreTexto + ' <span class="label-danger"><i class="">0</i> - ' + cupoMax.val() + '</span> <i class="fa fa-trash remove-equipo" onclick="removerEquipo(\'div-' + equipos + '\')"></i></div>' + 
                        hiddens +
                        '<div id="equipo-' + equipos + '" class="panel-body panel-receptor">' + 
                            '<ul class="receptor-jugadores sorteable" data-equipo="' + equipos + '">' + 
                            '</ul>' + 
                        '</div>' + 
                    '</div>';
        
        $("#contenedor-equipos").prepend(html);
        
        $("#equipo-" + equipos  + " ul").sortable({
            connectWith: '.listado-deportistas',
            helper: 'clone',
            appendTo: 'body',
            zIndex: 10000
        }).disableSelection();        
        
        $("#equipo-" + equipos + " ul").on('sortreceive', function(e, i){
            var equipo = $(this).attr("data-equipo");
            if(addDeportista(e, i, equipo)){
                // lobiAlert("error", "No puede agregar más jugadores a este equipo");
                i.sender.sortable('cancel');
            }
        });
        
        var id = "#equipo-" + equipos;
        $(id).mCustomScrollbar({
           theme: "rounded-dots", 
        });
        equipos ++;
    }
    
    function removerEquipo(id){
        var equipo = $("#" + id);
        equipo.slideUp(function(){
            equipo.find("li.rep-jugador").each(function(k,v){
                var e = $(v);
                removeFromArray(e.attr("data-id"));
            });
            equipo.remove();
        });
    }
    
    function removeFromArray(id){
        for(var i in deportistas){
            if(deportistas[i] === id){
                deportistas.splice(i, 1);
            }
        }
        console.log(deportistas);
    }
    
    function removerDeportista(e, i){
        var element = i.item;
        var idDeportista = element.attr("data-id");
        var contenedor = $("#" + element.attr("data-contenedor"));
        var id = element.attr("data-id");
        removeFromArray(id);
        
        if(contenedor.attr("data-ant") !== undefined){
            var tmpInput = $("#rm-jug-id-" + id);
            
            if(tmpInput.length){
                actualizarTotalJugadores(contenedor);
                return false;
            }
            contenedor.find("input.input-team").removeAttr("disabled");
            /* Remover jugador */
            var input1 = $("<input/>", { type:'hidden', id : 'rm-jug-id-' + id, name : 'deportista-remover[' + jugadoresRemovidos + '][deportista]'});
            input1.val(id);
            var input2 = $("<input/>", { type:'hidden', id : 'rm-jug-eq-' + id, name : 'deportista-remover[' + jugadoresRemovidos + '][equipo]'});
            input2.val(contenedor.attr("data-id-equipo"));
            input1.attr('data-remove-from', contenedor.attr("data-id-equipo"));
            $("#jugadores-remover").append(input1, input2);
            actualizarTotalJugadores(contenedor);
            jugadoresRemovidos ++;
            return false;
        }
        
        $("#depo-" + idDeportista).remove();
//        $("#table-collapsed-" + idDeportista).hide();
//        $("#table-expanded-" + idDeportista).show();
//        $("#deportista-" + idDeportista).removeClass("collapsed");
        actualizarTotalJugadores(contenedor);
    }
    
    function addDeportista(e, i, id){
        var edadMaxima = parseInt($("#edad-maxima-torneo").val());
        var element = i.item;
        var contenedor = $("#div-" + id);
        var idDep = element.attr("data-id");
        deportistas.push(idDep);
        /* Seteamos el id del contenedor */
        element.attr("data-contenedor", "div-" + id);

        var edad = parseInt(element.attr("data-edad"));

        if(edad > edadMaxima){
            lobiAlert('error', "el jugador no puede participar en este torneo, su edad supera la edad máxima del torneo");
            return true;
        }
        
        var devolver = actualizarTotalJugadores(contenedor);
        if(devolver === true){ 
            lobiAlert("error", "No puede agregar más jugadores a este equipo");
            return true; 
        }
        
        var idDeportista = element.attr("data-id");
        
        // validamos si el equipo es uno ya almacenado en base de datos 
        if(contenedor.attr("data-ant") !== undefined){
            var input = $("#rm-jug-id-" + idDep);
            var input2 = $("#rm-jug-eq-" + idDep);
            if(input.length && contenedor.attr("data-id-equipo") === input.attr("data-remove-from")){
                input.remove();
                input2.remove();
                return false;
            }
            contenedor.find("input.input-team").removeAttr("disabled");
        }
        
        var hidden = '<input id="depo-' + idDeportista + '" type="hidden" name="equipos[' + id + '][deportistas][]" value="' + idDeportista + '">';
//        $("#table-expanded-" + idDeportista).hide();
//        $("#table-collapsed-" + idDeportista).show();
//        $("#deportista-" + idDeportista).addClass("collapsed");
        contenedor.append(hidden);
        
        return false;
    }
    
    function actualizarTotalJugadores(contenedor){
        var total = contenedor.find(".rep-jugador").length;
        var max = parseInt(contenedor.attr("data-max"));
        var spanTotal = contenedor.find(".panel-heading span");
        var lbltotal = contenedor.find(".panel-heading span i");
        if(total === max){
            spanTotal.removeClass("label-danger").addClass("label-success");            
        } else if(total > max){
            return true;
        } else {
            spanTotal.removeClass("label-success").addClass("label-danger");
        }
        
        lbltotal.html(total);
        contenedor.attr("data-total", total);
        return false;
    }
    
</script>

<!-- 
<?php for($i = 0; $i < 4; $i ++): ?>                 
<li>
    <div class="deportista-equipo row">
        <div class="pic col-sm-3">
            <img src="<?= Sis::UrlRecursos() ?>/pics/child.png">
        </div>
        <div class="info col-sm-9">
            <table class="nombre table table-condensed">
                <tr>
                    <td>Nombre: </td><td>El Brallan </td>
                    <td>Categoría: </td><td>Pre pony </td>
                    <td>Posición: </td><td><span class="label label-success">Defensa</span> </td>
                </tr>
            </table>
            <table class="table-info table table-bordered table-condensed">
                <tr>
                    <td>Nombre: </td>
                    <td>El Brallan</td>
                </tr>
                <tr>
                    <td>Edad: </td>
                    <td>18</td>                                        
                </tr>
                <tr>
                    <td>Categoría: </td>
                    <td>Pre pony</td>
                </tr>
                <tr>
                    <td>Posición: </td>
                    <td><span class="label label-success">Defensa</span></td>
                </tr>
            </table>
        </div>
    </div>
</li>
<?php endfor ?>
-->