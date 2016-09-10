<?php
$this->tituloPagina = $modelo->getNombreMasUsuario();

Sis::Recursos()->recursoCss([
    'url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css',
]);
Sis::Recursos()->recursoJs([
    'url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js',
]);
?>
 
<div class="col-sm-4">
    <div class="tile p-15 text-center">
        <div id="actual">
                <?= $modelo->getFotoAsignada(); ?>
                <div class="p-5"></div>
                <?= CBoot::boton('Cambiar Foto '. CBoot::fa('picture-o'), 'primary', ['id' => 'btn-foto']) ?> 
            </div> 
        <div id="cambio" style="display: none">
            <div class="form-group">
                <input type="file" name="imagenes" id="cargar-imagen-1">
            </div>
        </div> 
    </div>
</div>    
<div id="f-t-info">
    <div class="col-sm-8">
        <div class="tile p-15">
            <div class="panel panel-default">
                <h4>Información Personal</h4>
                <hr>
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th><?php echo $modelo->obtenerEtiqueta('nombres') ?></th>
                            <td id="nombreCelda"><?php echo $modelo->nombres; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo $modelo->obtenerEtiqueta('apellidos') ?></th>
                            <td id="apellidoCelda"><?php echo $modelo->apellidos; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo $modelo->obtenerEtiqueta('telefono') ?></th>
                            <td id="telefonoCelda"><?php echo $modelo->telefono; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-4 text-center">
                        <br><?= CBoot::boton('Editar ' . CBoot::fa('pencil'), 'primary btn-block', ['id' => 'btn-editar']) ?>
                    </div>
                </div>
            </div>
        </div>    

        <div class="tile p-15">
            <div class="panel-heading text-center"></div>
                <div class="panel panel-default">
                <h4>Información de la Cuenta</h4>
                <hr>
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th><?php echo $modelo->obtenerEtiqueta('rol_id') ?></th>
                            <td><?php echo $modelo->Rol->nombre; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo $modelo->obtenerEtiqueta('email') ?></th>
                            <td><?php echo $modelo->email; ?></td>
                        </tr>

                        <tr>
                            <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                            <td><?php echo $modelo->EtiquetaEstado ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 
    <div id="f-t-form" style="display: none">
        <div class="col-sm-8">
            <div class="page-header">
                <div class="tile p-15">
                    <input type="hidden" id="id-ficha" value="<?= $modelo->id ?>">
                    <h5>Información Personal</h5>
                </div>
                <table class="table">
                    <tr>
                        <th class="text-right">Nombres:</th>
                        <td class="edit-cell"  data-input-edit-cell="true" data-val="<?= $modelo->nombres ?>">
                            <?= CBoot::text($modelo->nombres, ['id' => 'nombres']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Apellidos:</th>
                        <td class="edit-cell" data-input-edit-cell="true" data-val="<?= $modelo->apellidos ?>">
                            <?= CBoot::text($modelo->apellidos, ['id' => 'apellidos']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Teléfono:</th>
                        <td class="edit-cell" data-input-edit-cell="true" data-val="<?= $modelo->telefono ?>">
                            <?= CBoot::text($modelo->telefono, ['id' => 'telefono']) ?>
                        </td>
                    </tr>  
                </table>
            </div>
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4 text-center">
                    <?= CBoot::boton('Cancelar ', 'default', ['id' => 'btn-cancelar']) ?> 
                    <?= CBoot::boton('Actualizar ' . CBoot::fa('pencil'), 'success', ['id' => 'btn-actualizar']) ?>
                </div>
            </div> 
        </div>
    </div>    

    <script>
        $(function () {
            $("#cargar-imagen-1").fileinput({
                uploadUrl: "<?= Sis::crearUrl(['usuario/cambiarFoto']) ?>",
                uploadAsync: true,
                uploadExtraData: {
                    ajx: true,
                },  
                    
            }).on('fileuploaded', function(event, data, id, index){
                var respuesta = data.response;
                $("#actualfoto").attr("src",respuesta.url);
                $("#foto-perfil").attr("src",respuesta.url);
                $("#cambio").slideUp(function () {
                    $("#actual").slideDown();
                });
                if (respuesta.uploadErr === true) {
                    lobiAlert("error", "No se pudo guardar.");
                }   
        });
            
            $("#btn-foto").click(function () {
                $("#actual").slideUp(function () {
                    $("#cambio").slideDown();
                });
            });
            
            $("#btn-editar").click(function () {
                $("#f-t-info").slideUp(function () {
                    $("#f-t-form").slideDown();
                });
            });

            $("#btn-cancelar").click(function () {
                $("#f-t-form").slideUp(function () {
                    $("#f-t-info").slideDown();
                });
            });

            $("#btn-actualizar").click(function () {
                guardarFicha();
            });
        });

        function guardarFicha() {
            var nombres = $("#nombres").val();
            var apellidos = $("#apellidos").val();
            var telefono = $("#telefono").val();
            
            $.ajax({
                type: 'POST',
                url: '<?= Sis::crearUrl(['Usuario/editarPerfil', 'id' => $this->_g['id']]) ?>',
                data: {
                    ajx: true,
                    ficha: {
                        nombres: nombres,
                        apellidos: apellidos,
                        telefono: telefono,
                    },
                },
                success: function (obj) {
                    if (obj.error === false) {
                       
                        $("#f-t-form").slideUp(function () {
                            $("#f-t-info").slideDown();
                        });
                        $("#nombreCelda").html(nombres);
                        $("#apellidoCelda").html(apellidos);
                        $("#telefonoCelda").html(telefono);
                        
                        lobiAlert("success", "Se guardaron correctamente los datos.");
                        } else {
                        $("#f-t-form").slideUp(function () {
                            $("#f-t-info").slideDown();
                        });

                        lobiAlert("error", "Ocurrió un error al actualizar los datos.");
                    }
                }
            }); 
        }

    </script>