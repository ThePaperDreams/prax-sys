<?php 
    $this->tituloPagina = "Listar matriculas";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Matriculas'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Ver matrículas anuladas' => ['Matricula/matriculasAnuladas'],
            'Matricular deportista' => ['Matricula/matricular'],
            'Lista de espera' => ['Deportista/verListaEspera'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'exportar' => [
        'PDF' => ['url' => ['matricula/reporte'], 'nombre' => 'export-pdf', 'i' => 'file-pdf-o'],
    ],    
    'filtrosAjax' => [
        'deportista_id', 
        'categoria_id' => CBoot::select('', $categorias, ['defecto' => '---', 'style' => 'min-width: 150px;', 'name' => 'categoria_id', 'data-s22' => true]),
    ],
    'modelo' => 'Matricula',
    // 'criterios' => [
    //     'order' => 'estado = 1 DESC, fecha_realizacion DESC',
    // ],
    'criterios' => $criterios,
    # id_matricula, fecha_pago, url_comprobante, estado, deportista_id, categoria_id
    'columnas' => [
        'deportista_id' => 'Deportista->NombreIdentificacion',
        'club_id' => 'Club->nombre',
        'estado' => ['valor' => 'EtiquetaEstado', 'opciones' => ['class' => 'text-center']],
        'url_comprobante' => ['valor' => 'Comprobante', 'opciones' => ['class' => 'text-center']],
        'anio',
        'categoria_id' => 'Categoria->nombre',
    ],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver', 'url' => 'Matricula/ver&{id:pk}'],
        ['i' => 'ban', 'title' => 'Anular', 'url' => 'Matricula/anular&{id:pk}', 'visible' => '$m->estado == 1'],
    ],
    'paginacion' => 10,
]) ?>
<script>

</script>