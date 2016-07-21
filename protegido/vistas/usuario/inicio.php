<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Usuarios'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Usuario/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Usuario',
    # id_usuario, rol_id, email, nombre_usuario, nombres, apellidos, telefono, clave, recuperacion, estado
    'columnas' => 'id_usuario, nombres, apellidos, email',
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