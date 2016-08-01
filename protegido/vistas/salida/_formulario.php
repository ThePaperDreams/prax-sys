<?php
$formulario = new CBForm(['id' => 'form-salidas']);
$formulario->abrir();
?>
<div class="tile p-15">
<?php echo $formulario->lista($modelo, 'responsable_id', $usuarios, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto' => 'Responsable id']) ?>
<?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'fecha_entrega', ['label' => true, 'group' => true]) ?>
<div>
    <div class="form-group">
        <?= CBoot::selectM('', 'Implemento', 'id_implemento', 'nombre', ['label' => 'Implementos', 'group' => true, 'autofocus' => true, 'defecto' => 'Seleccione un implemento', 'id' => 'selectId']) ?>   
    </div>    
    <div class="form-group"style="">
        <span style="font-size:12px" class="label label-default">Unidades: <i id="total-unidades">0</i></span>
    </div>
    <?= CBoot::number(0, ['min' => 0, 'label' => 'Cantidad', 'group' => true, 'id' => 'cant']); ?>   
    <?= CBoot::boton('Agregar ' . CBoot::fa('plus-circle'), 'default', ['group' => true, 'id' => 'btnAgregar']) ?>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Nombre del implemento
                    </th>
                    <th>
                        Cantidad agregada
                    </th>
                    <th>
                        Eliminar
                    </th>
                </tr>
            </thead>
            <tbody id="datosTabla">

            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-offset-6 col-sm-3" atr=''>
        <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['salida/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block','id'=>'btn-send']); ?>
    </div>  
</div>
<script>
    $(document).ready(function () {
        $("#btnAgregar").click(function () {
            Agregar();
            return false;
        });
        $("#Salidas_fecha_entrega").datepicker({
            dateFormat: 'yy-mm-dd',
        });
         $("#Salidas_fecha_entrega").change(function(){
            validarFecha($(this));
        });
        $("#selectId").change(function(){
            if($(this).val() !== ""){
                traerDatosImplemento($(this).val());
            }
        });
        $("#cant").keyup(function(){
            var limite = parseInt($("#total-unidades").html());
            if($(this).val() > limite){
                lobiAlert("error", "No puede ingresar una cantidad mayor a las unidades actuales");
                var cant = $(this);
                cant.val(limite);
            }
        });
    });
   
   function traerDatosImplemento(id){
       $.ajax({
           type: 'POST',
           url: "<?= Sis::crearUrl(['Salida/crear']) ?>",
           data: {
               ajaxRequest: true,
               id: id,
           },
           success: function(respuesta){
               $("#total-unidades").html(respuesta.unidades);
               $("#cant").focus().select();
           }
       });
   }
   
    function Agregar() {
        var select = $("#selectId");
        var valor = select.val();
        var nombre = select.find("option:selected").text();
        var cantidad = $("#cant").val();


        if (valor === "") {
            return;
        }

        if ($("#remover-" + valor).length > 0) {
            return;
        }
        
        var hidden = '<input type="hidden" name="articulo[]" value="'+valor+'"><input type="hidden" name="cantity[]" value="'+cantidad+'">';
        
        var datosTabla = $("#datosTabla");
        var fila = '<tr id="remover-' + valor + '"><td>' + nombre + hidden + '</td><td>' + cantidad + '</td><td class="text-danger-icon text-center col-sm-1"><i class="fa fa-ban" onclick="Quitar(' + valor + ')" ></i></td></tr>';
        datosTabla.append(fila);

    }
 
    function Quitar(idFila) {
        var fila = $("#remover-" + idFila);
        fila.remove();
    }
    function validarFecha(fecha) {
        var currDate = new Date();
        var date = Date.parse(fecha.val());
        if (date >= currDate) {
            $('#btn-send').removeAttr("disabled");
        } else {
            alert("Por favor seleccione una fecha mayor a la de hoy");
            $('#btn-send').attr("disabled", "disabled");
        }
    }
</script>

<?php $formulario->cerrar(); ?>
</div>