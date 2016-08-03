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
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('tipo_documento_id') ?></th>
                    <td><?php echo $tiposIdentificaciones["$modelo->tipo_documento_id"]; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('identificacion') ?></th>
                    <td><?php echo $modelo->identificacion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_nacimiento') ?></th>
                    <td><?php echo $modelo->fecha_nacimiento; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre1') ?></th>
                    <td><?php echo $modelo->nombre1; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre2') ?></th>
                    <td><?php echo $modelo->nombre2; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('apellido1') ?></th>
                    <td><?php echo $modelo->apellido1; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('apellido2') ?></th>
                    <td><?php echo $modelo->apellido2; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('direccion') ?></th>
                    <td><?php echo $modelo->direccion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('telefono1') ?></th>
                    <td><?php echo $modelo->telefono1; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('telefono2') ?></th>
                    <td><?php echo $modelo->telefono2; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado_id') ?></th>
                    <td><?php echo $modelo->EtiquetaEstado; ?></td>
                </tr>
            </tbody>
        </table>
    </div>    
</div>
<?php if (!is_null($modelo->foto)): ?>
    <div id="thumb" class="col-sm-3">
        <div class="thumbnail">
            <img src="<?= Sis::UrlBase() ?>publico/imagenes/deportistas/fotos/<?= $modelo->foto . '?t=' . time(); ?>" alt="">
            <div class="caption text-center">
                <button id="btn-eliminar" class="btn btn-primary" type="button"><i class="fa fa-trash"></i></button>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h4 class="panel-title"><a data-toggle="collapse" href="#collapse">Documentos asociados actualmente <i class="fa fa-chevron-down"></i></a></h4>
        </div>  
        <div id="collapse" class="panel-collapse collapse">
            <table class="table">
                <thead>
                    <tr>
                        <th>Descargar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="tabla-documentos">
                    <?php foreach ($modelo->Documento AS $dc): ?>
                        <tr>
                            <td><?= $dc->Documento->getDocumento($modelo->id_deportista, $dc->Documento->url, get_class($modelo)); ?></td>            
                            <td class="col-sm-1 text-center text-danger-icon"><a class="eliminar" data-iddep="<?= $modelo->id_deportista ?>" data-nomtipo="<?= $dc->Documento->url ?>" data-iddoc="<?= $dc->documento_id ?>" data-iddepdoc="<?= $dc->id ?>" href="#"><i class="fa fa-ban"></i></a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h4 class="panel-title"><a data-toggle="collapse" href="#collapse1">Acudientes asociados actualmente <i class="fa fa-chevron-down"></i></a></h4>
        </div>  
        <div id="collapse1" class="panel-collapse collapse">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ver detalles</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="tabla-documentos">
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
<script>
    $(function () {
        $("a.eliminar").click(function () {
            if (confirm('¿Está seguro de eliminar este documento?')) {
                var a = $(this);
                var iddepdoc = a.attr("data-iddepdoc");
                var iddoc = a.attr("data-iddoc");
                var iddep = a.attr("data-iddep");
                var nomtipo = a.attr("data-nomtipo");
                $.ajax({
                    type: 'post',
                    url: "<?php echo Sis::crearUrl(['Deportista/EliminarDeportistaDocumento']) ?>",
                    data: {
                        iddepdoc: iddepdoc,
                        iddoc: iddoc,
                        iddep: iddep,
                        nomtipo: nomtipo
                    }
                }).done(function () {
                    $(a).closest("tr").remove();
                }).fail(function () {});
            }
            return false;
        });
        $("a.delete").click(function () {
            if (confirm('¿Está seguro de eliminar este acudiente?')) {
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
                    }).done(function () {
                        $(a).closest("tr").remove();
                    }).fail(function () {});
                } else {
                    alert('Mínimo un acudiente');
                }
            }
            return false;
        });
        $("#btn-eliminar").click(function () {
            if (confirm('¿Está seguro de eliminar la foto del deportista?')) {
                var dep = "<?= $modelo->id_deportista; ?>";
                var nom = "<?= $modelo->foto; ?>";
                $.ajax({
                    type: 'post',
                    url: "<?php echo Sis::crearUrl(['Deportista/EliminarFoto']) ?>",
                    data: {
                        dep: dep,
                        nom: nom
                    }
                }).done(function () {
                    $("#thumb").remove();
                }).fail(function () {});
            }
        });
    });
</script>    
