<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Torneos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Torneo/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Torneo',
    # id_torneo, cupo_maximo, cupo_minimo, edad_maxima, edad_minima, fecha_inicio, fecha_fin, nombre, observaciones, tabla_posiciones, equipo_id
    'columnas' => [
        'nombre',
        'cupo_minimo', 
        'edad_maxima',  
        'fecha_inicio',
        'equipo_id'=>'Equipo->nombre'
    ],
    'opciones' => true,
    'paginacion' => 10,
]) ?>