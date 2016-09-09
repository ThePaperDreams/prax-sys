<?php 
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/customScrollBar/CustomScrollBar.js']);
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . 'librerias/customScrollBar/CustomScrollBar.css']);
?>
<div class="tile p-15">
    
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <?= CBoot::text('', ['group' => true, 'label' => 'Nombre', 'id' => 'nombre']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= CBoot::select('', $usuarios, ['group' => true, 'label' => 'Entrenador', 'defecto' => 'Seleccione un entrenador', 'id' => 'entrenador']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= CBoot::number('', ['group' => true, 'label' => 'Cupo mínimo', 'min' => '1', 'id' => 'cupo-min']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= CBoot::number('', ['group' => true, 'label' => 'Cupo máximo', 'min' => '1', 'id' => 'cupo-max']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button id="add-team" class="btn btn-primary btn-block">Agregar equipo <?= CBoot::fa('plus') ?></button>
                        </div>
                    </div>
                </div>                
            </div>
            <hr>
            <h3>Equipos</h3>
            <hr>
            <div class="p-15"></div>
            <div id="contenedor-equipos"  class="contenedor-equipos">
                
            </div>
        </div>
        
        <div class="col-sm-6">
            <h3>Jugadores</h3>
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
    });
    
    function consultarJugadores(id){
        $.ajax({
            'type' : 'POST',
            'url' : '<?= Sis::CrearUrl(['torneo/ajx']) ?>',
            'data' : {
                'ajx' : true,
                'id' : id,
            },
            'success' : function (obj){
                $("#listado-deportistas").html(obj.html);
            },
        });
    }
    
    function agregarEquipo(){
        var nombre = $("#nombre");
        var entrenador = $("#entrenador");
        var cupoMin = $("#cupo-min");
        var cupoMax = $("#cupo-max");
        var error = function(msg){ lobiAlert('error', msg); };
        var vc = function(campo, n) {
            if($.trim(campo.val()) === ""){ error(n + " no puede ser vacio."); campo.focus(); return true; }
            else { return false; }            
        }
        if(vc(nombre, 'Nombre')){ return false; }
        else if(vc(entrenador, 'Entrenador')) {return false;}
        else if(vc(cupoMin, 'Cupo mínimo')){ return false; }
        else if(vc(cupoMax, 'Cupo máximo')){ return false;}
        
        var hiddens = '<input type="hidden" name="equipos[' + equipos + '][nombre]" value="' + nombre.val() + '">';
        hiddens += '<input type="hidden" name="equipos[' + equipos + '][entrenador]" value="' + entrenador.val() + '">';
        hiddens += '<input type="hidden" name="equipos[' + equipos + '][cupo-max]" value="' + cupoMax.val() + '">';
        hiddens += '<input type="hidden" name="equipos[' + equipos + '][cupo-min]" value="' + cupoMin.val() + '">';
        
        var html = '<div id="div-' + equipos + '" class="equipo panel panel-primary">' +
                        '<div class="panel-heading">' + nombre.val() + ' <span class="label-success"><i class="">0</i> - ' + cupoMax.val() + '</span> <i class="fa fa-remove"></i></div>' + 
                        hiddens +
                        '<div class="panel-body">' + 
                            '<ul id="equipo-' + equipos + '" class="receptor-jugadores sorteable" data-equipo="' + equipos + '">' + 
                            '</ul>' + 
                        '</div>' + 
                    '</div>';
        
        $("#contenedor-equipos").prepend(html);
        $("#equipo-" + equipos).sortable({
            connectWith: '.listado-deportistas',
            helper: 'clone',
            appendTo: 'body',
            zIndex: 10000
        }).disableSelection();
        $("#equipo-" + equipos).on('sortreceive', function(e, i){
            var equipo = $(this).attr("data-equipo");
            addDeportista(e, i, equipo);
        });
        var id = "#equipo-" + equipos;
//        setTimeout(function(){
            $(id).mCustomScrollbar({
                theme: "rounded-dots", 
            });
            $(id).css("background-color", "red");
//        }, 100);
        equipos ++;
    }
    
    function removerDeportista(e, i){
        var element = i.item;
        var idDeportista = element.attr("data-id");
        $("#depo-" + idDeportista).remove();
        $("#table-collapsed-" + idDeportista).hide();
        $("#table-expanded-" + idDeportista).show();
        $("#deportista-" + idDeportista).removeClass("collapsed");
    }
    
    function addDeportista(e, i, id){
        var element = i.item;
        var contenedor = $("#div-" + id);
        var idDeportista = element.attr("data-id");
        var hidden = '<input id="depo-' + idDeportista + '" type="hidden" name="equipos[' + id + '][deportistas][]" value="' + idDeportista + '">';
        $("#table-expanded-" + idDeportista).hide();
        $("#table-collapsed-" + idDeportista).show();
        $("#deportista-" + idDeportista).addClass("collapsed");
        contenedor.append(hidden);
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