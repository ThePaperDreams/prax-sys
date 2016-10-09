<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar EquiposTorneos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['EquipoTorneo/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'EquipoTorneo',
    # id_et, equipo_id, torneo_id
    'columnas' => 'id_et, equipo_id, torneo_id',
    'opciones' => true,
    'paginacion' => 10,
]) ?>