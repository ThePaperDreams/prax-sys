<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Publicaciones' => ['Publicacion/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Publicacion/inicio'],
        'Registrar' => ['Publicacion/crear'],
        'Modificar' => ['Publicacion/editar', 'id' => $modelo->id_publicacion],
    ]
];
$this->tituloPagina = "Ver publicación";
?>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('titulo') ?></th>
                    <td><?php echo $modelo->titulo; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('consecutivo') ?></th>
                    <td><?php echo $modelo->consecutivo; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_publicacion') ?></th>
                    <td><?php echo $modelo->fecha_publicacion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_disponibilidad') ?></th>
                    <td><?php echo $modelo->fecha_disponibilidad; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('tipo_id') ?></th>
                    <td><?php echo $modelo->TipoPublicacion->nombre ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado_id') ?></th>
                    <td><?php echo $modelo->EstadoPublic->nombre ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('usuario_id') ?></th>
                    <td><?php echo $modelo->Autor->nombres ?></td>
                </tr>
                <tr>
                    <th colspan="2">
                        <a href="<?= Sis::crearUrl(['Publicacion/visualizar', 'id' => $modelo->id_publicacion]) ?>" class="btn-block btn btn-success" target="_blank">
                            Visualizar <i class="fa fa-globe"></i>
                        </a>
                    </th>
                </tr>
            </tbody>
        </table>

    </div>
</div>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Comentarios
        </div>
        <table class="table table-bordered">
            <tbody>
                <?php if (count($modelo->comentarios) > 0): ?>
                    <?php foreach ($modelo->comentarios as $c): ?>
                <tr id="fila-<?= $c->id_comentario ?>" class="<?= $c->estado == 2? 'danger' : '' ?>">
                    <td><?= $c->comentario ?></td>
                    <td class="col-sm-1" data-id="<?= $c->id_comentario ?>" data-comentario="<?= $c->comentario ?>" data-usuario="<?= $c->Usuario->nombreCompleto  ?>" data-fecha="<?= $c->fecha ?>" data-estado="<?= $c->estado ?>">
                        <button class="btn btn-primary btn-ver-comentario">
                            <i class="fa fa-eye"></i>
                        </button>
                    </td>
                </tr>
                    <?php endforeach ?>
                <?php else: ?>
                <tr>
                    <td colspan="2">No hay comentarios</td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>

    </div>
</div>

<div class="modal fade" id="modal-comentarios">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id-comentario-seleccionado">
                <table class="table table-bordered">
                    <tr>
                        <th>Comentario </th>
                        <td id="modal-comentario"></td>
                    </tr>
                    <tr>
                        <th>Usuario </th>
                        <td id="modal-usuario"></td>
                    </tr>
                    <tr>
                        <th>Fecha </th>
                        <td id="modal-fecha"></td>
                    </tr>
                    <tr>
                        <th>Estado </th>
                        <td id="modal-estado"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button id="eliminar" class="btn-danger btn">
                    Elimianr <i class="fa fa-remove"></i>
                </button>
                <button id="aprobar" class="btn-success btn">
                    Aprobar <i class="fa fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $(".btn-ver-comentario").click(function(){
            $("#modal-comentarios").modal("show");
            var contenedor = $(this).closest("td");
            $("#modal-comentario").html(contenedor.attr("data-comentario"));
            $("#modal-usuario").html(contenedor.attr("data-usuario"));
            $("#modal-fecha").html(contenedor.attr("data-fecha"));
            var estado = contenedor.attr("data-estado");
            var strEstado = "";
            $("#id-comentario-seleccionado").val(contenedor.attr("data-id"));
            if(estado == "1"){
                strEstado = "Aprobado";
                $("#aprobar").hide();                
            } else if(estado == "2"){
                strEstado = "Pendiente";
                $("#aprobar").show();
            }

            $("#modal-estado").html(strEstado);
        });

        $("#aprobar").click(function(){
            sendAjax(1);
        });

        $("#eliminar").click(function(){
            confirmar("Confirmar", "Se eliminará cualquier respuesta asociada al comentario ¿Desea continuar?", function(){
                sendAjax(2);
            });
            // if(confirm("Se eliminará cualquier respuesta asociada al comentario ¿Desea continuar?")){
            // }
        });
    });

    function sendAjax(tipo){
        var id = $("#id-comentario-seleccionado").val();
        $.ajax({
            'type' : 'POST',
            'url' : '<?= Sis::crearUrl(['publicacion/ver', 'id' => $modelo->id_publicacion]) ?>',
            'data' : {
                id: id,
                tipo: tipo,
                ajxRqst: true,
            }
        }).done(function(data){
            if(data.error == true){

            } else if(data.error == false){
                var fila = $("#fila-" + id);
                if(data.estado == 0){
                    $("#modal-comentarios").modal("hide");
                    fila.find("td").slideUp(function(){
                        fila.remove();
                        window.location.reload();
                    });
                } else {
                    fila.removeClass("danger");
                    fila.find("[data-id='" + id + "']").attr("data-estado", data.estado);
                    lobiAlert("success", "Se aprobó el comentario");
                    $("#modal-comentarios").modal("hide");
                }
            } else {
                console.log("Ocurrió un error inesperado : " + data);
                lobiAlert("error", datas);
            }
        });
    }
</script>