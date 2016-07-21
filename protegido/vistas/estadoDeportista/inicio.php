<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar EstadoDeportistas'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['EstadoDeportista/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'EstadoDeportista',
    # id_estado, nombre, descripcion, icono, etiqueta
    'columnas' => 'id_estado, nombre, descripcion',
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