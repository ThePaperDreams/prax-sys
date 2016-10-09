<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Matriculas' => ['Matricula/inicio'],
        'Lista de espera',
    ];
    
    $this->opciones = [
        'elementos' => [
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
        <div class="col-sm-8">
            <?= CBoot::select('', $deportistas, ['name' => 'deportista', 'id' => 'cmb-deportista', 'defecto' => 'Seleccione un deportista', 'data-s2' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= CBoot::boton('Enviar a lista de espera', 'primary') ?>
        </div>
    </div>
    
</div>
<?php $formulario->cerrar(); ?>
<script>
    $(function(){
        setTimeout(function(){
            $("#cmb-deportista").select2('open');
        }, 200);
    });
</script>