<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar EstadosPublicacion'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['EstadoPublicacion/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'EstadoPublicacion',
    # id_estado, nombre, descripcion
    'columnas' => 'id_estado, nombre, descripcion',
    'opciones' => true,
    'paginacion' => 10,
]) ?>