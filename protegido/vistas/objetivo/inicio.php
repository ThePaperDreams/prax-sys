<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Objetivos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Objetivo/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Objetivo',
    'filtros' => 'titulo',
    # id_objetivo, titulo, descripcion, plan_trabajo_id
    'columnas' => 'titulo, descripcion',
    'opciones' => true,
    'paginacion' => 10,
]) ?>