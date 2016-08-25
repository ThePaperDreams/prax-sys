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

<?php $this->abrirSeccion("antes-de-opciones") ?>

<div class="row">
    <div class="col-lg-6">
        <a href="<?= Sis::crearUrl(['pago/generarReporte']) ?>" target="_blank">
        <?php
        $icon=  CBoot::fa('file-pdf-o');
        echo CBoot::boton('Generar pdf '.$icon,'primary',['id'=>'generar_pdf']);
        ?>
        </a>
    </div>
</div>
<div class="p-5"></div>

<?php $this->cerrarSeccion() ?>

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
        ['i' => 'eye', 'title' => 'Ver','url' => 'pago/ver&{id:pk}'],
        ['i' => 'refresh', 'title' => 'Cambiar estado','url' => 'pago/anular&{id:pk}', 'visible' => '$m->estado == 1', 'opciones' => ['class' => 'op-eliminar','id'=>'cambioE']],
    ],
    'paginacion' => 10,
]) ?>
<?php 

