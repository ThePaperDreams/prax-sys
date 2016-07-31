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
    'modelo' => 'Equipo',
    # id_equipo, cupo_maximo, cupo_minimo, estado, posicion, entrenador_id, deportista_id
    'columnas' => 'id_equipo, cupo_maximo, cupo_minimo, estado',
    'opciones' => true,
    'paginacion' => 10,
]) ?>