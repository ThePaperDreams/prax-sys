<?php
$this->tituloPagina = "Lista de espera";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas' => ['deportista/iniio'],
    'Lista de espera',
];

$this->opciones = [
    'elementos' => [
        'Registrar deportista' => ['Deportista/crear'],
    ]
];
?>

<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Deportista',
    'criterios' => [
        'where' => 'estado_id = 4',
    ],
# id_deportista, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, foto, telefono1, telefono2, fecha_nacimiento, estado_id, tipo_documento_id
     'columnas' => [
        'identificacion',
        'nombre1',
        'apellido1',
        'telefono1',
        'telefono2',
    ],
    'paginacion' => 10,
])
?>