<?php 
$this->tituloPagina = "Gestionar equipos de: Torneo " . $torneo->nombre;
$this->migas = [
    'Listar torneos' => ['torneo/inicio'],
    'Ver torneo' => ['torneo/ver', 'id' => $this->_g['id']],
    'Gestionar equipos',
];

Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/customScrollBar/CustomScrollBar.js']);
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . 'librerias/customScrollBar/CustomScrollBar.css']);
?>
<div class="col-sm-6">
    <form method="POST" id="form-equipos">
        
        <div class="tile p-15">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="p-15"></div>
                        <div class="row">
                            <div class="alert alert-info col-sm-12">
                                Agregue equipos que participaron en el torneo.
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </div>
                        </div>
                        <div class="row" id="buttons-options">
                            <div class="col-sm-4">
                                <a href="#" class="btn btn-default btn-block">Cancelar </a>
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
                                    <?= CBoot::number('', ['group' => true, 'label' => 'Cupo máximo', 'min' => '1', 'id' => 'cupo-max']) ?>
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

                    </div>
                </div>
            </div>
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
    $(function(){
        $("#form-equipos").submit(function(){ return false; });
        $("#finish-editing").click(function(){
            document.getElementById("form-equipos").submit();
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
    
    var deportistas = [];
    
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
                lobiAlert("error", "No puede agregar más jugadores a este equipo");
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
        console.log(deportistas);
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
        $("#depo-" + idDeportista).remove();
        $("#table-collapsed-" + idDeportista).hide();
        $("#table-expanded-" + idDeportista).show();
        $("#deportista-" + idDeportista).removeClass("collapsed");
        actualizarTotalJugadores(contenedor);
    }
    
    function addDeportista(e, i, id){
        var element = i.item;
        var contenedor = $("#div-" + id);
        var idDep = element.attr("data-id");
        deportistas.push(idDep);
        /* Seteamos el id del contenedor */
        element.attr("data-contenedor", "div-" + id);
        
        var devolver = actualizarTotalJugadores(contenedor);       
        if(devolver === true){ return true; }
        
        var idDeportista = element.attr("data-id");
        var hidden = '<input id="depo-' + idDeportista + '" type="hidden" name="equipos[' + id + '][deportistas][]" value="' + idDeportista + '">';
        $("#table-expanded-" + idDeportista).hide();
        $("#table-collapsed-" + idDeportista).show();
        $("#deportista-" + idDeportista).addClass("collapsed");
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