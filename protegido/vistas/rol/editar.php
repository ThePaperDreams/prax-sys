<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Roles' => ['Rol/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Rol/inicio'],
            'Crear' => ['Rol/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'modelo2'=>$modelo2, 'rutas'=>$rutas]); ?>
</div>
<script>
    var r = [];
<?php foreach ($modelo->getRutas() as $k => $v): ?>
        r.push(<?= $v->id_ruta; ?>);
<?php endforeach; ?>
    console.log(r);
    $(function () {
        if (r.length > 0) {
            for (var i = 0; i < r.length; i++) {
                $("#Rutas_id_ruta option").each(function () {
                    if (parseInt($(this).val()) === r[i]) {
                        $(this).attr("disabled", "true");
                        return false;
                    }
                });
            }
        }
    });
</script>