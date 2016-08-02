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
    'modelo' => 'PrestamoDeportista',
    # id_prestamo, clubOrigen, clubDestino, fecha_inicio, fecha_fin, estado, deportista_id, tipo_prestamo
    'columnas' => 'nombreDeportista, clubOrigen, clubDestino, fecha_inicio, fecha_fin, etiquetaTipo',
    'opciones' => true,
    'paginacion' => 10,
]) ?>