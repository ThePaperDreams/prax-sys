<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Matriculas'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Matricular deportista' => ['Matricula/matricular'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Matricula',
    # id_matricula, fecha_pago, url_comprobante, estado, deportista_id, categoria_id
    'columnas' => [
        'deportista_id' => 'Deportista->NombreIdentificacion',
        'estado' => 'EtiquetaEstado',
        'url_comprobante' => 'Comprobante',
        'anio',
        'categoria_id' => 'Categoria->nombre',
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Matricula/ver&{id:pk}'],
        ['i' => 'ban', 'url' => 'Matricula/anular&{id:pk}', 'visible' => '$m->estado == 1'],
    ],
    'paginacion' => 10,
]) ?>