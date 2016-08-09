<?php 
    $this->tituloPagina = "Listar matriculas";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Matriculas'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Matricular deportista' => ['Matricula/matricular'],
            'Lista de espera' => ['Deportista/verListaEspera'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Matricula',
    'criterios' => [
        'order' => 'estado = 1 DESC, fecha_realizacion DESC',
    ],
    # id_matricula, fecha_pago, url_comprobante, estado, deportista_id, categoria_id
    'columnas' => [
        'deportista_id' => 'Deportista->NombreIdentificacion',
        'estado' => 'EtiquetaEstado',
        'url_comprobante' => 'Comprobante',
        'anio',
        'categoria_id' => 'Categoria->nombre',
    ],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver', 'url' => 'Matricula/ver&{id:pk}'],
        ['i' => 'ban', 'title' => 'Editar', 'url' => 'Matricula/anular&{id:pk}', 'visible' => '$m->estado == 1'],
    ],
    'paginacion' => 10,
]) ?>