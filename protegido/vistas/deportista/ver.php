<?php
$this->tituloPagina = "Ver Deportista";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas' => ['Deportista/inicio'],
    'Ver'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Deportista/inicio'],
        'Registrar' => ['Deportista/crear'],
        'Actualizar' => ['Deportista/editar', 'id' => $modelo->id_deportista],
    ]
];
?>
<div class="tile p-15">
<div class="row">
    <div class="panel-heading">
        <h4>Detalles del Deportista</h4>
    </div>
<div class="col-sm-6">
    <div class="panel panel-default">
        <!--<div class="panel-heading text-center">
            Ver detalles
        </div>-->
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('tipo_documento_id') ?></th>
                    <td><?php echo $modelo->TipoIdentificacion->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre1') ?></th>
                    <td><?php echo $modelo->nombre1; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('apellido1') ?></th>
                    <td><?php echo $modelo->apellido1; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('telefono1') ?></th>
                    <td><?php echo $modelo->telefono1; ?></td>
                </tr>
                <tr>                    
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_nacimiento') ?></th>
                    <td><?php echo $modelo->fecha_nacimiento; ?></td>
                </tr>                
                <tr>                    
                    <th><?php echo $modelo->obtenerEtiqueta('foto') ?></th>
                    <td id="pho"><?php echo $modelo->ImagenPerfil; ?></td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>
    <div class="col-sm-6">
    <div class="panel panel-default">
        <!--<div class="panel-heading text-center">
            Ver detalles
        </div>-->
        <table class="table table-bordered table-hover">
            <tbody>                
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('identificacion') ?></th>
                    <td><?php echo $modelo->identificacion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre2') ?></th>
                    <td><?php echo $modelo->nombre2; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('apellido2') ?></th>
                    <td><?php echo $modelo->apellido2; ?></td>
                </tr>
                <tr>                    
                    <th><?php echo $modelo->obtenerEtiqueta('telefono2') ?></th>
                    <td><?php echo $modelo->telefono2; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('direccion') ?></th>
                    <td><?php echo $modelo->direccion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado_id') ?></th>
                    <td><?php echo $modelo->EtiquetaEstado; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<?php if (!is_null($modelo->foto)): ?>
<div id="photo" class="modal cortina">
  <div class="p-modal"> <!-- p-modal-content el modal toma el tamaño de la foto -->
      <div class="p-modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Foto del Deportista</h4>
      </div>
      <div class="p-modal-body">
        <!--<img src="<?php #echo Sis::UrlBase() ?>publico/imagenes/deportistas/fotos/thumbs/tmb_<?php #echo $modelo->foto . '?t=' . time(); ?>" alt="">-->
        <img src="<?= Sis::UrlBase() ?>publico/imagenes/deportistas/fotos/<?= $modelo->foto . '?t=' . time(); ?>" alt="">                
      </div>
      <div class="p-modal-footer">
        <a class="btn btn-primary" target="_blank" href="<?php echo Sis::UrlBase() ?>publico/imagenes/deportistas/fotos/<?= $modelo->foto; ?>" download="<?php echo $modelo->foto; ?>"><i class="fa fa-cloud-download"></i> Descargar</a>
        <button id="cerrar-modal" type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <button id="btn-eliminar" class="btn btn-primary" type="button"><i class="fa fa-trash"></i> Eliminar</button>
      </div>
    </div>
</div>
<?php endif; ?>        
<?php if(count($modelo->Documento)): ?>
<div class="row">
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h4 class="panel-title"><a data-toggle="collapse" href="#collapse">Documentos <i class="fa fa-chevron-down"></i></a></h4>
        </div>  
        <div id="collapse" class="panel-collapse collapse">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modelo->Documento AS $d): ?>
                        <tr>
                            <td><?php echo $d->Documento->getDocumento($d->Documento->url); ?>
                            <td class="col-sm-1 text-center text-danger-icon">
                                <a href="#" class="eliminar" data-iddepdoc="<?php echo $d->id; ?>"><i class="fa fa-ban"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php endif; ?>
<div class="row">
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h4 class="panel-title"><a data-toggle="collapse" href="#collapse1">Acudientes <i class="fa fa-chevron-down"></i></a></h4>
        </div>  
        <div id="collapse1" class="panel-collapse collapse">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Acudiente</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modelo->Acudiente AS $dc): ?>
                        <tr>                                    
                            <td><?= $dc->Acudiente->getAcudiente($dc->Acudiente->id_acudiente, $dc->Acudiente->datos); ?></td>            
                            <td class="col-sm-1 text-center text-danger-icon"><a class="delete" data-iddepacu="<?= $dc->id ?>" href="#"><i class="fa fa-ban"></i></a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>                
        </div>
    </div>
</div>
</div>
<script>
    $(function () {
        $("a.eliminar").click(function(){
            if (confirm('¿Está seguro de eliminar este Documento?')) {
                var that_a = $(this);
                var iddepdoc = that_a.attr("data-iddepdoc");
                $.ajax({
                    method: "POST",
                    url: "<?php echo Sis::crearUrl(['Deportista/EliminarDeportistaDocumento']); ?>",
                    data: {iddepdoc: iddepdoc}
                }).done(function(resp){
                    if (resp["tipo"] === "success") {                        
                        that_a.closest("tr").remove();
                    }
                    lobiAlert(resp.tipo, resp.msj);
                });    
            }
            return false;
        });
        $("a.delete").click(function () {
            if (confirm('¿Está seguro de eliminar este Acudiente?')) {
                var len = $("a.delete");
                if (len.length > 1) {
                    var a = $(this);
                    var iddepacu = a.attr("data-iddepacu");
                    $.ajax({
                        type: 'post',
                        url: "<?php echo Sis::crearUrl(['Deportista/EliminarAcudiente']) ?>",
                        data: {
                            iddepacu: iddepacu
                        }
                    }).done(function (resp) {
                        if (resp["tipo"] === "success") {
                            $(a).closest("tr").remove();    
                        }
                        lobiAlert(resp.tipo, resp.msj);
                    });
                } else {
                    lobiAlert('error','El Deportista debe contar mínimo con un Acudiente');
                }
            }
            return false;
        });
        $("#btn-eliminar").click(function () {
            if (confirm('¿Está seguro de eliminar la Foto del Deportista?')) {
                var dep = "<?php echo $modelo->id_deportista; ?>";
                //var nom = "<?php #echo $modelo->foto; ?>";
                $.ajax({
                    type: 'post',
                    url: "<?php echo Sis::crearUrl(['Deportista/EliminarFoto']) ?>",
                    data: {
                        dep: dep,
                        //nom: nom
                    }
                }).done(function (resp) {
                    if (resp.tipo === "success") {                    
                        $("#cerrar-modal").click();
                        $("#pho").html("<span class='label label-info'>Ninguna</span>");                        
                    }
                    lobiAlert(resp.tipo, resp.msj);
                }).fail(function () {});
            }
        });
    });
</script>    
