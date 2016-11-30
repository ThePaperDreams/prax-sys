<?php
$this->tituloPagina = "Ver Rol";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Roles' => ['Rol/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Rol/inicio'],
        'Registrar' => ['Rol/crear'],
        'Actualizar' => ['Rol/editar', 'id' => $modelo->id_rol],
        'Asignar permisos' => ['Permiso/asignar'],
    ]
];
?>
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre') ?></th>
                    <td><?php echo $modelo->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?php echo $modelo->descripcion; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="col-sm-12">

        <div class="tile p-15">
            <div class="row">                
                <div class="page-hader">
                    <h4>Permisos</h4>                
                </div>
                <hr>
                <div class="col-sm-6">
                    <div class="list-group">
                        <?php foreach ($modulos as $key => $value): ?>
                        <a href="#" data-id="<?= $modelo->id_rol ?>" data-module="<?= $value->id ?>" class="list-group-item module"><?= $value->nombre  ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <table class="table table-borderd" id="permisos">
                        <thead>
                            <tr>
                                <th>Acción</th>
                                <th class="col-sm-1 text-center">Si</th>
                                <th class="col-sm-1 text-center">No</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td colspan="3" class="text-center">No ha seleccionado ningún módulo</td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $(".module").click(function(){
            var modulo = $(this).attr("data-module");
            var rol = $(this).attr("data-id");
            consultarPermisos(rol, modulo);
        });
    });

    function consultarPermisos(rol, modulo){
        
        $.ajax({
            type: 'POST',
            url: '<?= Sis::apl()->crearUrl(['rol/ver', 'id' => $modelo->id_rol]) ?>',
            data: {
                ajx: true,
                'get-permisos' : true,
                rol: rol,
                module: modulo,
            },
        }).done(function(data){
            if(data.error == false){
                construirTablaPermisos(data.permisos);
            } else {

            }
        });
    }

    function construirTablaPermisos(permisos){
        var tabla = $("#permisos");
        var cuerpo = tabla.find("tbody");
        var mostrar = function(){
            cuerpo.fadeIn();
        };

        var construir = function(){            
            if(permisos.length == 0){
                var tr = $("<tr/>").append($("<td/>", {'class' : 'text-center', 'colspan' : 3}).html("No hay acciones para este módulo"));
                cuerpo.append(tr);
            } else {
                $.each(permisos, function(k, v){
                    var tr = $("<tr/>");
                    var tdNombre = $("<td/>");
                    var tdSi = $("<td/>", {'class' : 'text-center'});
                    var tdNo = $("<td/>", {'class' : 'text-center'});
                    var icono = $("<i/>", {'class' : 'fa'});

                    if(v.permiso == true){
                        icono.addClass("fa-check");
                        tdSi.append(icono);
                    } else {
                        icono.addClass("fa-remove");
                        tdNo.append(icono);
                    }

                    tdNombre.html(v.ruta);
                    tr.append(tdNombre, tdSi, tdNo);
                    cuerpo.append(tr);
                    console.log(tr);
                });
            }
        }

        cuerpo.fadeOut(function(){
            cuerpo.html("");
            construir();
            mostrar();
        });

    }
</script>