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
    # id_prestamo, clubOrigen, clubDestino, fecha_inicio, fecha_fin, estado, deportista_id, tipo_prestamo
//    'columnas' => 'nombreDeportista, club_origen, club_destino, fecha_inicio, fecha_fin, etiquetaTipo',
    'columnas' => [
        'deportista_id' => 'NombreDepCompleto',
        'club_origen',
        'club_destino',
        'fecha_inicio',
        'fecha_fin',
        'tipo_prestamo' => 'etiquetaTipo',
    ],
    'opciones' => true,
    'paginacion' => 10,
]) ?>