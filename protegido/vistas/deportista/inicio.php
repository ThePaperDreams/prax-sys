<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Deportistas'
    ];

$this->opciones = [
        'elementos' => [
        'Crear' => ['Deportista/crear'],
    ]
];
?>

<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Deportista',
# id_deportista, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, foto, telefono1, telefono2, fecha_nacimiento, estado, tipo_documento_id
    'columnas' => 'id_deportista, identificacion, nombre1, nombre2, apellido1, apellido2',
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