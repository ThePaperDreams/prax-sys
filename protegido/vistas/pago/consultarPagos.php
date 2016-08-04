<?php 
    $this->tituloPagina="Consultar pagos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Pagos pendientes',
    ];
    
    $this->opciones = [
        'elementos' => [
            'Pagos pendientes' => ['pago/pagosPendientes'],
        ]
    ];    
    
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => $pagos,
    # id_plan_trabajo, descripcion, fecha_aplicacion, estado, categoria_id
    'columnas' => [
        'fecha',
        'valorFormateado',
        'url_comprobante',
        'estado' => 'EtiquetaEstado',
        'descuento',        
        'matricula_id' => 'MatriculaPago->Deportista->nombreCompleto',
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'pago/ver&{id:pk}'],
        ['i' => 'refresh', 'url' => 'pago/anular&{id:pk}', 'visible' => '$m->estado == 1', 'opciones' => ['class' => 'op-eliminar']],
    ],
    'paginacion' => 10,
]) ?>
<?php 