<?php 
    $this->tituloPagina = "Listar Estados de Deportistas";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Estados de Deportistas'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['EstadoDeportista/crear'],
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