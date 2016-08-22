<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Eventos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Evento/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Evento',
    # id_evento, titulo, contenido, fecha_publicacion, fecha_disponibilidad, tipo_id, lugar, hora, estado
    'columnas' => ['titulo, fecha_publicacion',
        'autor'=>'Autor->nombres',
        'tipo'=>'TipoEvento->nombre',
        'estado'=>'Estado->nombre'],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Evento/ver&{id:pk}'],
        ['i' => 'pencil', 'url' => 'Evento/editar&{id:pk}'],
    ],
    'paginacion' => 10,
]) ?>