<?php
$this->tituloPagina="Crear entrada de implementos";
$formulario = new CBForm(['id' => 'form-entradas']);
$formulario->abrir();

?>
<div class="tile p-15">
<?php echo $formulario->lista($modelo, 'responsable_id', $usuarios, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto' => 'Seleccione un Responsable']) ?>
<?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>

<div>
    <div class="form-group">
        <?= CBoot::selectM('', 'Implemento', 'id_implemento', 'nombre', ['label'=>'Implementos','defecto' => 'Seleccione un Implemento', 'id' => 'selectId']) ?>  
    </div>
    <?= CBoot::number(0, ['min' => 0,'label'=>'Cantidad', 'group' => true, 'id' => 'cant']); ?>     
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
        <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['entrada/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>
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
                validarEnt();
                } 
            return false;
        });
    });

    function Agregar() {
        var select = $("#selectId");
        var valor = select.val();
        var nombre = select.find("option:selected").text();
        var cantidad = $("#cant").val();
        

        if (valor === "") {
            return;
        }
        
        if($("#remover-"+valor).length > 0){
            return;
        }
        
        var hidden = '<input type="hidden" name="articulo[]" value="'+valor+'"><input type="hidden" name="cantity[]" value="'+cantidad+'">';

        var datosTabla = $("#datosTabla");
        var fila = '<tr data-implemento="true" id="remover-' + valor + '"><td>' + nombre + hidden + '</td><td>' + cantidad + '</td><td class="text-danger-icon text-center col-sm-1"><i class="fa fa-ban" onclick="Quitar(' + valor + ')" ></i></td></tr>';
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
<?php $formulario->cerrar(); ?>
</div>