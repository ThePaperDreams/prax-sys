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
            'Registrar' => ['Objetivo/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => ['titulo'],
    'exportar' => [
        'PDF' => ['i' => 'file-pdf-o', 'url' => ['objetivo/reporte']],
    ],
    'modelo' => 'Objetivo',
    'filtros' => 'titulo',
    # id_objetivo, titulo, descripcion, plan_trabajo_id
    'columnas' => [
        'titulo',
        'resumen',
    ],
    'opciones' => true,
    'paginacion' => 10,
]) ?>