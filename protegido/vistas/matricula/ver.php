<?php
Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput_locale_es.js']);

$this->tituloPagina = "Ver matricula";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Ver Matriculas' => ['Matricula/inicio'],
    'Detalles de matricula'
];

$this->opciones = [
    'elementos' => [
        'Ver Matriculas' => ['Matricula/inicio'],
        'Matricular deportista' => ['Matricula/matricular'],
    ]
];
?>
<div class="col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            Detalles
        </div>
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('fecha_pago') ?></th>
                    <td><?= $modelo->fecha_pago; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('fecha_realizacion') ?></th>
                    <td><?= $modelo->fecha_realizacion; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('url_comprobante') ?></th>
                    <?php if ($modelo->Comprobante !== false): ?>
                    <td><?= $modelo->Comprobante; ?></td>
                    <?php else: ?>
                    <td>
                        <?= CHtml::e("span", 'Ninguno', ['class' => 'label label-default']); ?> 

                        <a data-toggle="modal" href="#cargar-comprobante-modal" id="cargar-comprobante">¿Cargar comprobante?</a>
                    </td>
                    <?php endif ?>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?= $modelo->EtiquetaEstado; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('deportista_id') ?></th>
                    <td>
                        <?= CHtml::link($modelo->Deportista->NombreIdentificacion, ['deportista/ver', 'id' => $modelo->deportista_id]) ?>
                    </td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('categoria_id') ?></th>
                    <td><?= $modelo->Categoria->nombre; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

<form action="<?= Sis::crearUrl(['matricula/cargar', 'id' => $this->_g['id']]) ?>" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="cargar-comprobante-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Cargar comprobante</h4>
                </div>
                <div class="modal-body">
                        <label for="">Seleccione un documento</label>
                        <div id="file-input-container">
                            <?= CBoot::fileInput('', ['id' => 'documento-cargar', 'name' => 'Documentos']) ?>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(function(){
        $("#documento-cargar").fileinput({
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo",
            maxFileSize: 5000,
            allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg'],
            language: 'es',
        });
    });
</script>