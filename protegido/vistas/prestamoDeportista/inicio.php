<?php 
    $this->tituloPagina = "Préstamo de deportistas";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Préstamos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['PrestamoDeportista/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'deportista_id',
        'club_origen',
        'club_destino',
        'fecha_inicio' => CBoot::text('',['name' => 'fecha_inicio', 'class' => 'campo-fecha']),
        'fecha_fin' => CBoot::text('',['name' => 'fecha_fin', 'class' => 'campo-fecha']),
        'tipo_prestamo' => CBoot::select('', ['salida' => 'Salida', 'entrada' => 'Entrada'], ['defecto' => 'Tipo', 'style' => 'min-width: 150px;', 'name' => 'tipo_prestamo']),
    ],
    'modelo' => 'PrestamoDeportista',
    'criterios' => [
        'order' => 'estado = 1 DESC, id_prestamo DESC'
    ],
    # id_prestamo, clubOrigen, clubDestino, fecha_inicio, fecha_fin, estado, deportista_id, tipo_prestamo
//    'columnas' => 'nombreDeportista, club_origen, club_destino, fecha_inicio, fecha_fin, etiquetaTipo',
    'columnas' => [
        'deportista_id' => 'NombreDepCompleto',
        'club_origen',
        'club_destino',
        'fecha_inicio',
        'estado' => 'EtiquetaEstado',
        'fecha_fin',
        'tipo_prestamo' => ['valor' => 'etiquetaTipo', 'opciones' => ['class' => 'text-center']],
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'PrestamoDeportista/ver&{id:pk}', 'title' => 'Ver'],
        ['i' => 'pencil', 'url' => 'PrestamoDeportista/editar&{id:pk}', 'title' => 'Editar'],
        ['i' => 'check', 'url' => 'PrestamoDeportista/finalizar&{id:pk}', 'title' => 'Finalizar'],
        ['i' => 'trash', 'url' => 'PrestamoDeportista/eliminar&{id:pk}', 'title' => 'Eliminar', 'opciones' => ['class' => 'op-eliminar']],
    ],
    'paginacion' => 10,
]) ?>