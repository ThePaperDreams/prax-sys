<?php
$formulario = new CBForm(['id' => 'form-implementos']);
$formulario->abrir();
?>

<?php echo $formulario->lista($modelo, 'categoria_id', $elementos, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto' => 'Selecciona una categoría']) ?>
<?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoNumber($modelo, 'unidades', ['label' => true, 'group' => true,'min'=>'0']) ?>
<?php echo $formulario->campoNumber($modelo, 'minimo_unidades', ['label' => true, 'group' => true,'min'=>'0']) ?>
<?php echo $formulario->campoNumber($modelo, 'maximo_unidades', ['label' => true, 'group' => true,'min'=>'0']) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['implemento/inicio'], ['class' => 'btn btn-primary btn-block', 'id' => 'btn-send']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block', 'id' => 'btnGuardar']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>
<script>
    $(function(){
        $("#form-implementos").submit(function(){
            if(maxMin()){
                validarNombre();
            }
            return false;
        });
        
        function validarNombre(){
            var nombre = $("#Implementos_nombre");
            if(nombre === ""){ return; }
            
            $.ajax({
                type: 'POST',
                url: '<?= $url ?>',
                data: {
                    validarNombre: true,
                    nombre : nombre.val(),
                }, 
                success: function(respuesta){
                    if(respuesta.error == true){
                        mostrarAlert("error", "Ya existe ese nombre");
                    }else{
                        document.getElementById("form-implementos").submit();
                    }
                }
            });
        }
        
        function mostrarAlert(tipo, msg){
            Lobibox.notify(tipo, {
                size: 'mini',
                showClass: 'bounceInRight',
                hideClass: 'bounceOutRight',
                msg:msg,
                delay: 5000,
                soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/',
            });
        }
        
        function maxMin(){
        var maximo = $('#Implementos_maximo_unidades').val();
        var current = $('#Implementos_unidades').val();
        var minimo = $('#Implementos_minimo_unidades').val();
        if(maximo<current){
            mostrarAlert('error','Unidades no puede superar al maximo');
            if(minimo>maximo){
            mostrarAlert('error','Unidades minimas no pueden superar al maximo');
        }
            return false;
        }else{
            return true;
        }
        
    }
        
    });
</script>
