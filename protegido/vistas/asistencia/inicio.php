<?php 
    $this->tituloPagina = "Asistencias tomadas";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Asistencia'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Tomar asistencia' => ['Asistencia/tomarAsistencia'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'fecha' => CBoot::text('',['name' => 'fecha', 'class' => 'campo-fecha']), 
        'novedad', 
        'categoria_id' => CBoot::select('', $categorias, ['defecto' => 'Categoría', 'style' => 'min-width: 150px;', 'name' => 'categoria_id', 'data-s2' => true]),
        'realizada_por' => CBoot::select('', $usuarios, ['defecto' => 'Usuario', 'style' => 'min-width: 150px;', 'name' => 'realizada_por', 'data-s2' => true]),
    ],
    'modelo' => 'Asistencia',
    # id_inasistencia, fecha, novedad, realizada_por, categoria_id
    'columnas' => [
        'fecha', 'novedad', 
        'categoria_id' => 'Categoria->nombre',
        'realizada_por' => 'Usuario->nombreMasUsuario'
    ],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver', 'url' => 'asistencia/ver&{id:pk}'],
    ],
    'paginacion' => 10,
]) ?>