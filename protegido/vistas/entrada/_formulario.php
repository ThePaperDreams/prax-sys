<?php
$this->tituloPagina="Crear entrada de implementos";
$formulario = new CBForm(['id' => 'form-entradas']);
$formulario->abrir();

?>
<div class="tile p-15">
<div class="col-sm-6">
    <?php echo $formulario->lista($modelo, 'responsable_id', $usuarios, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto' => 'Seleccione un Responsable', 'data-s2' => true]) ?>
    <?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true, 'rows' => 8]) ?>
</div>
<div class="col-sm-6">
    <?= CBoot::selectM('', 'Implemento', 'id_implemento', 'nombre', ['label'=>'Implementos','defecto' => 'Seleccione un Implemento', 'id' => 'selectId', 'group' => true, 'data-s2' => true]) ?>  
    <?= CBoot::number(0, ['min' => 0,'label'=>'Cantidad', 'group' => true, 'id' => 'cant']); ?>     
    <?= CBoot::boton('Agregar ' . CBoot::fa('plus-circle'), 'default btn-block', ['group' => true, 'id' => 'btnAgregar']) ?>
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
        <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['entrada/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>
<?php $formulario->cerrar(); ?>
<script>
    $(document).ready(function () {
        $("#btnAgregar").click(function () {
            Agregar();
            return false;
        });
        
        $("#form-entradas").submit(function(){
            if($("[data-implemento]").length === 0){
                lobiAlert("error", "Añada por lo menos un implemento");   
            }else{
                return true;
            }
                return false;
        });
    });

    function Agregar() {
        var select = $("#selectId");
        var valor = select.val();
        var nombre = select.find("option:selected").text();
        var cantidad = $("#cant").val();
        

        if (valor === "" || cantidad <= 0) {
            return;
        }
        
        if($("#remover-"+valor).length > 0){
            return;
        }
        
        var hidden = '<input type="hidden" name="articulo[]" value="'+valor+'"><input class="cantity" type="hidden" name="cantity[]" value="'+cantidad+'">';

        var datosTabla = $("#datosTabla");
        var fila = $("<tr/>", {"data-implemento": "true", id: 'remover-' + valor});
        var icon = $("<i/>", {class: 'fa fa-trash'});
        var tdCantidad = $("<td/>");
        tdCantidad.html(cantidad);

        fila.append($("<td/>").html(nombre + hidden));
        fila.append(tdCantidad);
        fila.append($("<td/>", {class: 'text-danger-icon text-center col-sm-1'}).html(icon));

        // eventos
        icon.click(function(){
            Quitar(valor);
        });
        tdCantidad.dblclick(function(){
            var input = $("<input/>", {class: 'form-control', type: 'number'});
            var td = $(this);
            var valorActual = td.html();
            input.val(valorActual);
            td.html(input);
            input.focus().select();

            var removerInput = function(){
                if(input.val() == ""){
                    td.html(valorActual);
                } else {
                    td.html(input.val());
                    td.closest("tr").find(".cantity").val(input.val());
                }
            };

            input.blur(function(){
                removerInput();  
            }).keyup(function(e){
                if(e.which === 13){
                    removerInput();
                }
            });

        });

        datosTabla.append(fila);

    }

    function Quitar(idFila) {
        var fila = $("#remover-" +idFila);
        fila.remove();
    }
    
    function validarEnt(){
        var cant = $("#cant").val();
        if(parseInt(cant)=== 0){
            mostrarAlert('error','Unidades maximas no pueden ser cero');
            return false;
        }else{
            return true;
        }
    }
</script>
</div>
