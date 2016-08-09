<?php 
    $this->ayuda = "objetivos/inicio";
    $this->ayudaTitulo = "Listado de objetivos";
    $this->tituloPagina = "Listar objetivos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar objetivos'
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