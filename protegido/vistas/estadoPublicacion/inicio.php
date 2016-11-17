<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Configuraciones' => ['principal/configuracion'],
        'Listar EstadosPublicacion'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['EstadoPublicacion/crear'],
        ]
    ];
    $this->tituloPagina = "Estados de publicación";
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'EstadoPublicacion',
    # id_estado, nombre, descripcion
    'columnas' => 'nombre, descripcion',
    'opciones' => true,
    'paginacion' => 10,
]) ?>