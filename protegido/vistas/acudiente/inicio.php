<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Acudientes'
];

$this->opciones = [
        'elementos' => [
        'Crear' => ['Acudiente/crear'],
    ]
];
?>

<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Acudiente',
    # id_acudiente, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, email, telefono1, telefono2, estado, tipo_doc_id
    'columnas' => 'id_acudiente, identificacion, nombre1, nombre2, apellido1, apellido2',
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