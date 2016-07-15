<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Publicaciones'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Publicacion/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Publicacion',
    # id_publicacion, titulo, contenido, consecutivo, fecha_publicacion, fecha_disponibilidad, tipo_id, lugar, hora, estado_id, usuario_id
    'columnas' => 'id_publicacion, titulo, contenido, consecutivo',
    'opciones' => true,
    'paginacion' => 10,
]) ?>