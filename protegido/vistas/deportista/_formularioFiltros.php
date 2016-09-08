<?php 
$f = new CBForm(['id' => 'form-filtros']); 
$f->abrir();
?>
<div class="tile p-15">
    <div class="row">
        <div class="col-sm-3">
            <?= CBoot::text($identificacion, ['label' => 'Identificación', 'group' => true, 'name' => 'identificacion']); ?>
        </div>
        <div class="col-sm-3">
            <?= CBoot::text($nombre, ['label' => 'Deportista', 'group' => true, 'name' => 'deportista']); ?>            
        </div>
        <div class="col-sm-3">
            <?= CBoot::select($categoria, $categorias, ['defecto'=> 'Categoría', 'label' => 'Categoría', 'group' => true, 'name' => 'categoria']) ?>            
        </div>
        <div class="col-sm-3">
            <?= CBoot::select($estado, $estados, ['defecto'=> 'Estado', 'label' => 'Estado', 'group' => true, 'name' => 'estado']) ?>
        </div>
        <div class="col-sm-12">
            <button id="btn-vista" class="btn btn-primary" name="btn-vista">Vista Previa</button>
            <button id="btn-generar" type="button" class="btn btn-primary" name="btn-generar">Generar PDF</button>
        </div>
    </div>
</div>
<?php $f->cerrar(); ?>
<script>
    $(function(){
       $("#btn-generar").click(function(){
           if($("#cb-grid tbody tr").length === 0){
                lobiAlert('error', 'No hay registros');
                $("#form-filtros").submit(function(){return false;});
            }
            $("#form-filtros").submit();
       }); 
    });
    /*$("#form-filtros").submit(function(){
        if($("#cb-grid tbody tr").length < 0){
            lobiAlert('error', 'No hay registros');
            return false;
        }
    });*/
    
</script>
    