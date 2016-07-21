<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposDocumento'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['TipoDocumento/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'TipoDocumento',
    # id_tipo, nombre, descripcion, padre_id
    'columnas' => 'id_tipo, nombre, descripcion',
    'opciones' => true,
    'paginacion' => 10,
])
?>

<script>
    $(function(){
        $("a[href*='eliminar']").click(function(){
            if (confirm('¿Seguro que desea eliminar este registro?') === false) {
                return false;
            }
        });
    });
</script>