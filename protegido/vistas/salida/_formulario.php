<?php
$formulario = new CBForm(['id' => 'form-salidas']);
$formulario->abrir();
?>
<div class="tile p-15">
<div class="col-sm-6">
    <?php echo $formulario->lista($modelo, 'responsable_id', $usuarios, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto' => 'Seleccione un Responsable', 'data-s2' => true]) ?>
    <?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true, 'rows' => 10]) ?>
</div>
<div class="col-sm-6">
    <?php echo $formulario->campoTexto($modelo, 'fecha_entrega', ['label' => true, 'group' => true, 'class'=>'campo-fecha']) ?>
    <div class="form-group">
        <label for="">Implementos</label>
        <div class="input-group">            
            <?= CBoot::selectM('', 'Implemento', 'id_implemento', 'nombre', ['data-s2' => true, 'autofocus' => true, 'defecto' => 'Seleccione un Implemento', 'id' => 'selectId']) ?>   
            <div class="input-group-addon">
                <span style="font-size:12px" class="label label-default">Unidades: <i id="total-unidades">0</i></span>
            </div>
        </div>
    </div>    
    <div>
        <div class="form-group">
            <label for="">Cantidad</label>
            <div class="input-group">
                <?= CBoot::number(0, ['min' => 0, 'id' => 'cant']); ?>   
                <div class="input-group-btn">                
                    <?= CBoot::boton('Agregar ' . CBoot::fa('plus-circle'), 'default', ['id' => 'btnAgregar']) ?>
                </div>
            </div>
        </div>
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
        
        $("#form-salidas").submit(function(){
            if($("[data-implemento]").length === 0){
                lobiAlert("error", "Añada por lo menos un implemento");                 
            }else{
                return true;
            }
            return false;
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
        var maximo = parseInt($("#total-unidades").html());

        if (valor === ""|| cantidad <= 0) {
            return;
        }

        if ($("#remover-" + valor).length > 0) {
            return;
        }

        if(parseInt(cantidad) > maximo){
            cantidad = maximo;
        }
        
        var hidden = '<input type="hidden" name="articulo[]" value="'+valor+'"><input type="hidden" class="cantidad" name="cantity[]" value="'+cantidad+'">';
        
        var datosTabla = $("#datosTabla");
        
        var fila = $("<tr/>", {'data-implemento' : 'true', id: 'remover-' + valor});
        fila.append($("<td/>").html(nombre + hidden));
        var tdCantidad = $("<td/>").html(cantidad);
        tdCantidad.attr("data-max", maximo);
        fila.append(tdCantidad);
        var icon = $("<i/>", {class: 'fa fa-trash'});
        fila.append($("<td/>", {class : 'text-danger-icon text-center col-sm-1'}).html(icon));

        tdCantidad.dblclick(function(){
            var valor = $(this).html();
            var input = $("<input/>", {class: 'form-control'});
            tdCantidad.html(input);
            input.val(valor);
            input.focus().select();

            var removerInput = function(){
                var max = parseInt(tdCantidad.attr("data-max"));
                var nuevoValor = input.val();
                if($.trim(nuevoValor) === ""){
                    tdCantidad.html(valor);
                } else {
                    if(parseInt(nuevoValor) > max){ nuevoValor = max; }
                    tdCantidad.html(nuevoValor);
                    var hd = tdCantidad.closest("tr").find("input.cantidad");
                    hd.val(nuevoValor);                    
                }

            };

            input.blur(function(){
                removerInput();
            });
            input.keyup(function(e){
                if(e.which == 13){
                    removerInput();
                    return;
                }
            });
        });

        icon.click(function(){
            Quitar(valor);
        });

        datosTabla.append(fila);

    }
 
    function Quitar(idFila) {
        var fila = $("#remover-" + idFila);
        fila.remove();
    }
    function validarFecha(fecha) {
        var d = new Date();
        var fechaActualStr = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + (d.getDate() < 10? '0' : '') + d.getDate();
        var currDate = Date.parse(fechaActualStr);
        var date = Date.parse(fecha.val());

        if (date < currDate) {
            lobiAlert("error", "Por favor seleccione una fecha mayor o igual a la de hoy");
            $('#btn-send').attr("disabled", "disabled");
        } 
        if(date > currDate) {
            $('#btn-send').removeAttr("disabled");
        }
    }
    function validarSal(){
        var cant = $("#cant").val();
        if(parseInt(cant)=== 0){
            mostrarAlert('error','Unidades maximas no pueden ser cero');
            return false;
        }else{
            return true;
        }
    }
</script>

<?php $formulario->cerrar(); ?>
</div>