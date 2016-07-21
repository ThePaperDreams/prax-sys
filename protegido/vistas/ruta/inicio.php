<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Rutas'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Ruta/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Ruta',
    # id_ruta, nombre, ruta
    'columnas' => 'id_ruta, nombre, ruta',
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