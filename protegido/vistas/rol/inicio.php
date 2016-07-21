<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Roles'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Rol/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Rol',
    # id_rol, nombre, descripcion, desarrollador
    'columnas' => 'id_rol, nombre, descripcion',
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