<?php 
    $this->tituloPagina = "Listar Tipos de Documentos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Tipos de Documentos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['TipoDocumento/crear'],
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