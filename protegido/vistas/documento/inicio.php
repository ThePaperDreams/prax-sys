<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Documentos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Documento/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Documento',
    # id_documento, url, titulo, tipo_id, papelera
    'columnas' => 'id_documento, url, titulo',
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