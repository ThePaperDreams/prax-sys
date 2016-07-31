<?php 
$formulario = new CBForm(['id' => 'form-roles']);
$formulario->abrir();
?>
<?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
<?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>

<div class="row">
    <div class="col-sm-9">
        <?php echo $formulario->lista($ruta, 'id_ruta', $rutas, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto'=>'']) ?>
    </div>
    <div class="col-sm-3">
        
    </div>
</div>

<div id="lst-rut" class="panel panel-default">
    <div class="panel-heading">Rutas</div>
    <ul id="lis-rut" class="list-group">
    </ul>
</div>

<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->lista($modulo, 'id', $modulos, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto'=>'']) ?>
    </div>
    <div class="col-sm-6">
<div class="block-area" id="check">
    <h3 class="block-title">Permisos</h3>
    <!--<p>Default Checkbox</p>-->
    <div class="checkbox m-b-5">
        <label>
            <input type="checkbox" checked>
            This is an awesome sample Checkbox
        </label>
    </div>
    <div class="clearfix"></div>
    <div class="checkbox m-b-5">
        <label>
            <input type="checkbox">
            This is another awesome sample Checkbox
        </label>
    </div>
    <div class="clearfix"></div>
    <div class="checkbox m-b-5">
        <label>
            <input type="checkbox">
            One more awesome sample Checkbox
        </label>
    </div>
</div>
    </div>
    
    </div>

<div class="row">
    <?php echo "<pre>"; ?>
    <?php var_dump($rutt); ?>
</div>


<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['rol/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>
<?php $formulario->cerrar(); ?>
<script>
    $(function () {
        $("#Modulos_id").change(function(){
           //alert($(this).val());
           var id = $(this).val();
           $.ajax({
              type: 'post',
              url: "<?= $url ?>",
              data: {
                  id: id
              }
           }).done(function(resp){
               //console.log(resp);
               //console.log(resp);
               var r = JSON.parse(resp);
               console.log(r);
               console.log(resp);
               console.log(resp[0]['"_atributos":"CBaseModelo":"private"']);               
               //console.log(resp[0].["_atributos":"CBaseModelo":private]);
               //resp = JSON.parse(resp);
               //console.log(resp);
               /*$.each(resp, function(i, v){
                  console.log(v); 
               });*/
           });
        });
    });
</script>