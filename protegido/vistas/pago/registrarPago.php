<?php 
Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);
$this->tituloPagina="Registrar pago";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Registrar pago',
    ];
    
    $this->opciones = [
        'elementos' => [
            'Consultar pagos' => ['pago/consultar'],
        ]
    ];
?>
<div class="tile p-15">
    <table class="table table-bordered">
        <tbody id="pagos-pendientes">
            <tr>
                <th>Deportista</th>
                <td>
                    <?= $matricula->Deportista->nombreDePila ?>
                </td>
            </tr>
            <tr>
                <th>Fecha</th>
                <td>
                    <?= $modelo->fecha ?>
                </td>
            </tr>
            <tr>
                <th>Categoría</th>
                <td>
                    <?= $matricula->Categoria->nombre ?>
                </td>
            </tr>
        </tbody>
    </table>
<?php 
$formulario = new CBForm(['id' => 'form-pagos', 'opcionesHtml' => ['enctype' => 'multipart/form-data']]);
$formulario->abrir();
?>
<?php echo $formulario->campoNumber($modelo, 'valor_cancelado', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoNumber($modelo, 'descuento', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->areaTexto($modelo, 'razon_descuento', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoArchivo($modelo, 'url_comprobante', ['label' => true, 'group' => true]) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['pago/pagosPendientes'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>
</div>

<script>
    $(function(){
        jQuery("#Pagos_url_comprobante").fileinput({
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo",
        });
    });
</script>