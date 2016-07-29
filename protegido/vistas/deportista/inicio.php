<?php
$this->tituloPagina = "Listar Deportistas";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas'
];

$this->opciones = [
    'elementos' => [
        'Registrar' => ['Deportista/crear'],
    ]
];
?>

<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Deportista',
# id_deportista, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, foto, telefono1, telefono2, fecha_nacimiento, estado_id, tipo_documento_id
     'columnas' => [
        'identificacion',
        'nombre1',
        'apellido1',
        'telefono1',
        'estado_id' => 'EtiquetaEstado'
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Deportista/ver&{id:pk}'],
        ['i' => 'pencil', 'url' => 'Deportista/editar&{id:pk}'],
        ['i' => 'refresh', 'url' => 'Deportista/cambiarEstado&{id:pk}'],
    ],
    'paginacion' => 10,
])
?>