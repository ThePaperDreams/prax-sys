<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Equipos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Equipo/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'nombre',
        'cupo_maximo',
        'cupo_minimo',
        'posicion'
     ],
    
    'modelo' => 'Equipo',
    # id_equipo, cupo_maximo, cupo_minimo, estado, posicion, entrenador_id, deportista_id
    'columnas' => ['nombre', 'cupo_maximo', 'cupo_minimo', 'posicion',],
    'opciones' => true,
    'paginacion' => 10,
]) ?>