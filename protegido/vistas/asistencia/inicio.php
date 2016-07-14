<?php 
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
    'modelo' => 'Asistencia',
    # id_inasistencia, fecha, novedad, realizada_por, categoria_id
    'columnas' => [
        'fecha', 'novedad', 
        'categoria_id' => 'Categoria->nombre',
        'realizada_por' => 'Usuario->nombreMasUsuario'
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'asistencia/ver&{id:pk}'],
    ],
    'paginacion' => 10,
]) ?>