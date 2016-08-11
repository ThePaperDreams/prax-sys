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
<div class="row">
    <div class="col-lg-6">
<?php
$icon=  CBoot::fa('file-pdf-o');
echo CBoot::boton('Generar pdf '.$icon,'primary',['id'=>'generar_pdf','group'=>true]);
?>
        </div>
</div>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Pago',
    # id_plan_trabajo, descripcion, fecha_aplicacion, estado, categoria_id
    'columnas' => [
        'fecha',
        'valorFormateado',
        'url_comprobante' => 'UrlDescarga',
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