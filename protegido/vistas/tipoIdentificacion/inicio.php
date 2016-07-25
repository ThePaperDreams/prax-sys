<?php 
    $this->tituloPagina = "Listar Tipos de Identificación";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Tipos de Identificación'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['TipoIdentificacion/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'TipoIdentificacion',
    # id_tipo_documento, nombre, abreviatura
    'columnas' => 'id_tipo_documento, nombre, abreviatura',
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