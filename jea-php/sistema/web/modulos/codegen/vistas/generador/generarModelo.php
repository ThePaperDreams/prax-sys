<?php 
$f = new CBForm([
    'id' => 'crear_modelo',
]);
$f->abrir();
?>
<?php if(Sis::Sesion()->existeNotificacion("modelo")): ?>
<?php $not = Sis::Sesion()->getNotificacion("modelo"); ?>
<div class="alert alert-<?php echo ($not['error'] == true? 'danger' : 'success'); ?>">
    <?php echo $not['msg']; ?>
</div>
<?php endif; ?>

<div class="form-group">
    <label>¿De que tabla generará el modelo?</label>
    <?php echo CBoot::select('', $tablas, ['name' => 'tabla', 'id' => 'tabla', 'defecto' => 'Seleccione una tabla', 'data-select-two' => 'true']); ?>
</div>
<div class="form-group">
    <label>Nombre del modelo</label>
    <?= CBoot::text('', ['id' => 'nombre', 'name' => 'nombre']) ?>
</div>
<div class="form-group">
    <label>¿Sobreescribir el modelo si ya existe?</label>
    <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-primary">
            <input type="radio" name="sobreescribir" id="override-yes" autocomplete="off" value="1"> Si
        </label>
        <label class="btn btn-default active">
            <input type="radio" name="sobreescribir" id="override-no" autocomplete="off" value="0" checked> No
        </label>
    </div>
</div>
<div class="form-group">
    <?php echo CBoot::botonS(CBoot::fa('pencil-square-o') . ' Crear modelo', ['id' => 'crear', 'name' => 'crear-modelo', 'class' => 'btn-block', 'disabled' => 'disabled'])?>
</div>

<?php $f->cerrar(); ?>
<script>
    String.prototype.toCamelCase = function(){
        var str = this;
        var partes = str.split(" ");
        var resultado = "";
        for(p in partes){
            var primeraLetra = (partes[p].length > 0)? partes[p][0].toUpperCase() : "";
            var resto = partes[p].substr(1);
            resultado += primeraLetra + resto;
        }
        return resultado;
    }      
    function nombreModelo(obj){
        var nombre = obj.select2('data')[0].text.replace(/tbl_/g, '');
        var ultimaLetra = nombre.substr(nombre.length - 1);
        if(ultimaLetra == "s"){
            nombre = nombre.substr(0, nombre.length - 1);
        }
        jQuery("#nombre").val(nombre.toCamelCase());
    }
    jQuery(function(){
        setTimeout(function(){
            jQuery("#tabla").select2("open");
        }, 100);
        jQuery("#tabla").change(function(){
            nombreModelo(jQuery(this));
            if(jQuery(this).val() === ""){
                jQuery("#crear").attr("disabled", "disabled");
            } else {
                jQuery("#crear").removeAttr("disabled");
            }
        });
    });
</script>
