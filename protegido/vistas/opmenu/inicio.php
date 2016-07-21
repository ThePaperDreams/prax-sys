<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Opmenu'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Opmenu/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Opmenu',
    # id, texto, ruta_id, padre_id
    'columnas' => 'id, texto, ruta_id, padre_id',
    'opciones' => true,
    'paginacion' => 10,
]) ?>
<script>
    $(function(){
        $("a[href*='eliminar']").click(function(){
            if (confirm('¿Seguro que desea eliminar este registro?') === false) {
                return false;
            }
        });
    });
</script>