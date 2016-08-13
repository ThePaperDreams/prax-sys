<?php
$this->tituloPagina = "Ver Acudiente";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Acudientes' => ['Acudiente/inicio'],
    'Ver'
];
$this->opciones = [
    'elementos' => [
        'Listar' => ['Acudiente/inicio'],
        'Registrar' => ['Acudiente/crear'],
        'Actualizar' => ['Acudiente/editar', 'id' => $modelo->id_acudiente],
    ]
];
?>
<div class="tile p-15">
<div class="row">
    <div class="panel-heading">
        <h4>Detalles del Acudiente</h4>
    </div>
<div class="col-sm-6">
    <div class="panel panel-default">
        <!--<div class="panel-heading text-center">
            Ver detalles
        </div>-->
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('tipo_doc_id') ?></th>
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
                    <th><?php echo $modelo->obtenerEtiqueta('direccion') ?></th>
                    <td><?php echo $modelo->direccion; ?></td>
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
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->EtiquetaEstado; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center">            
            <a href="#docs" class="collapsed" role="button" data-toggle="collapse" aria-controls="docs">Documentos asociados actualmente <i class="fa fa-chevron-down"></i></a>            
        </div>          
        <div id="docs" class="panel-collapse collapse">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Descargar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="tabla-documentos">
                    <?php foreach ($modelo->Detalles AS $dc): ?>
                        <tr>
                            <td><?php echo $dc->Documento->getDocumento($modelo->id_acudiente, $dc->Documento->url, get_class($modelo)); ?></td>
                            <!--<td><?php #echo $dc->Documento->getDocumento($dc->Documento->url, $dc->Documento->titulo); ?></td>-->
                            <td class="col-sm-1 text-center text-danger-icon"><a class="eliminar" data-idacu="<?= $modelo->id_acudiente ?>" data-nomtipo="<?= $dc->Documento->url ?>" data-iddoc="<?= $dc->documento_id ?>" data-idacudoc="<?= $dc->id ?>" href="#"><i class="fa fa-ban"></i></a></td>
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
        $(".eliminar").click(function () {
            if (confirm('¿Está seguro de eliminar este documento?')) {
                var a = $(this);
                var idacudoc = a.attr("data-idacudoc");
                var iddoc = a.attr("data-iddoc");
                var idacu = a.attr("data-idacu");
                var nomtipo = a.attr("data-nomtipo");
                $.ajax({
                    type: 'post',
                    url: "<?php echo Sis::crearUrl(['Acudiente/EliminarAcudienteDocumento']) ?>",
                    data: {
                        idacudoc: idacudoc,
                        iddoc: iddoc,
                        idacu: idacu,
                        nomtipo: nomtipo
                    }
                }).done(function () {
                    $(a).closest("tr").remove();
                }).fail(function () {});
            }
            return false;
        });
    });
</script>    