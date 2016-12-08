<?php 
Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput_locale_es.js']);

$this->tituloPagina="Registrar pago";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Registrar pago',
    ];
    
    $this->opciones = [
        'elementos' => [
            'Pagos pendientes' => ['pago/pagosPendientes'],
            'Pagos realizados' => ['pago/realizados'],
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
<div class="col-sm-6">
    <?php echo $formulario->inputAddon($modelo, 'valor_cancelado', 'number', ['label' => true, 'group' => true, 'class' => 'solo-numeros maximo-numero', 'max' => '100000'], ['pre' => '$']) ?>
    <?php echo $formulario->inputAddon($modelo, 'descuento', 'number', ['label' => true, 'group' => true, 'class' => 'solo-numeros maximo-numero', 'max' => '100000'], ['pre' => '$']) ?>
    <div class="form-group">
        <label for="Pagos_url_comprobante">Comprobante <span class="text-danger">*</span></label>
        <?php echo $formulario->campoArchivo($modelo, 'url_comprobante', []) ?>
    </div>
</div>

<div class="col-sm-6">
    <label for="">Razón descuento <span id="total-chars">0</span>/<span id="max-chars">500</span> </label>
    <?php echo $formulario->areaTexto($modelo, 'razon_descuento', ['rows' => 8, 'disabled' => true]) ?>
</div>
<hr>
<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['pago/pagosPendientes'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' Registrar', 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>
</div>

<script>
    var valorAnterior = 0;
    $(function(){
        $("#form-pagos").submit(function(){
            var input = $("#Pagos_url_comprobante");
            if(input.val() == ""){
                lobiAlert("error", "Debe cargar un comprobante");
                return false;
            }
        });

        $("#Pagos_razon_descuento").keydown(function(e){
            var t = $(this);
            var max = parseInt($("#max-chars").html());
            $("#total-chars").html(t.val().length);
            if(t.val().length >= max && ( e.which != 8 && e.which !== 116)){
                e.preventDefault();
                return false;
            }
        });

        $("#Pagos_descuento").keyup(function(e){
            var cancelado = parseInt($("#Pagos_valor_cancelado").val());
            var descuento = parseInt($(this).val());
            if(descuento > cancelado){
                $(this).val(valorAnterior);
            } else {
                valorAnterior = $(this).val();
            }

            if(descuento > 0){
                $("#Pagos_razon_descuento").removeAttr("disabled").attr("required", "true");
            } else {
                $("#Pagos_razon_descuento").attr("disabled", "disabled").removeAttr("required");
            }

        });

        jQuery("#Pagos_url_comprobante").fileinput({
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo",
            language: 'es',
        });
    });
</script>