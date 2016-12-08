<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Matriculas' => ['Matricula/inicio'],
        'Lista de espera',
    ];
    $this->tituloPagina = "Enviar deportista a lista de espera";
    $this->opciones = [
        'elementos' => [
            'Lista de espera' => ['deportista/verListaEspera'],
            'Matricular deportista' => ['Matricula/matricular'],
            'Registrar deportista' => ['Deportista/crear'],
        ]
    ];

$formulario = new CBForm(['id' => 'form-matriculas', 'opcionesHtml' => ['enctype' => 'multipart/form-data']]);
$formulario->abrir();
?>
<div class="tile p-15">
    <p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
    <div class="row">
        <div class="form-group">
            <label for="">Seleccione una categoría</label>
            <p id="cat-edades">Edades: </p>
            <?= CBoot::select('', $categorias, ['name' => 'categoria', 'id' => 'cmb-categoria', 'defecto' => 'Seleccione una categoría', 'data-s2' => true]) ?>
        </div>
        <div class="form-group">
            <label for="">Seleccione un deportista</label>
            <?= CBoot::select('', $deportistas, ['name' => 'deportista', 'id' => 'cmb-deportista', 'defecto' => 'Seleccione un deportista', 'data-s2' => true]) ?>
        </div>
        <hr>
        <div class="form-group">
            <?= CBoot::boton('Enviar a lista de espera', 'primary btn-block') ?>
        </div>
    </div>
    
</div>
<?php $formulario->cerrar(); ?>
<script>
    $(function(){
        $("#form-matriculas").submit(function(){
            var categoria = $("#cmb-categoria");
            var depo = $("#cmb-deportista");
            if(categoria.val() == ""){
                lobiAlert("error", "Por favor seleccione una categoría");
                categoria.select2("open");
                return false;

            } else if(depo.val() == ""){
                depo.select2("open");
                lobiAlert("error", "Por favor seleccione un deportista");
                return false;
            }

            return true;
        });

        setTimeout(function(){
            $("#cmb-categoria").select2('open');
        }, 200);

        jQuery("#cmb-categoria").change(function(){
            if(jQuery(this).val() === ""){
                $("#btn-send").attr("disabled", "disabled");
            } else {                
                doAjax(2, jQuery(this).val());
            }
        });

    });

    function doAjax(type, id){
        jQuery.ajax({
            url: "<?= Sis::crearUrl(['matricula/validar']) ?>",
            type: "post",
            data: {
                ajx:true,
                type: type,
                id: id,
            },
            success: function(r){
                $("#cat-edades").html(r.datos.edades);
                consultarDeportistas(r.datos.emin, r.datos.emax);
            }
        });
    }

    function consultarDeportistas(min, max){
        $.ajax({
            type    :  'POST',
            url     : '<?= Sis::crearUrl(['matricula/ajax']); ?>',
            data    : {
                ajx : true,
                type: 'deportistas',
                min : min,
                max : max,
            }
        }).done(function(data){
            // if(data.error == false){
                var combo = $("#cmb-deportista");
                combo.select2("destroy");
                combo.html(data.ops);
                combo.select2({ width: '100%'});
                combo.select2("open");
            // }
        });
    }
    
</script>