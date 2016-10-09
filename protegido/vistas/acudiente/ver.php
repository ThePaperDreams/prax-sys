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
                <tr>                    
                    <th><?php echo $modelo->obtenerEtiqueta('email') ?></th>
                    <td><?php echo $modelo->email; ?></td>
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
<?php if(count($modelo->Detalles)): ?>
<div class="row">
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center">            
            <a href="#docs" class="collapsed" role="button" data-toggle="collapse" aria-controls="docs">Documentos <i class="fa fa-chevron-down"></i></a>            
        </div>          
        <div id="docs" class="panel-collapse collapse">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Descargar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modelo->Detalles AS $d): ?>
                        <tr>
                            <td><?php echo $d->Documento->getDocumento($d->Documento->url); ?>
                            <td class="col-sm-1 text-center text-danger-icon">
                                <a href="#" class="eliminar" data-idacudoc="<?php echo $d->id; ?>"><i class="fa fa-ban"></i></a>
                            </td>
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
                var idacudoc = that_a.attr("data-idacudoc");
                $.ajax({
                    method: "POST",
                    url: "<?php echo Sis::crearUrl(['Acudiente/EliminarAcudienteDocumento']); ?>",
                    data: {idacudoc: idacudoc}
                }).done(function(resp){
                    if (resp["tipo"] === "success") {                        
                        that_a.closest("tr").remove();
                    }
                    lobiAlert(resp.tipo, resp.msj);
                });    
            }
            return false;
        });
    });
</script>    
<?php endif; ?>