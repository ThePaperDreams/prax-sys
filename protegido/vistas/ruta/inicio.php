<?php 
    $this->tituloPagina = "Listar Rutas";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Rutas'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['Ruta/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Ruta',
    # id_ruta, nombre, ruta, modulo_id
    'columnas' => [
        'nombre',
        'ruta',
        'modulo_id' => 'Modulo->nombre',
    ],
    'opciones' => true,
    'paginacion' => 10,
]) ?>