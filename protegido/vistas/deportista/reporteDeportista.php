<?php
$this->tituloPagina = "Generar Reporte de Deportistas";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Generar Reporte de Deportistas'
];

/*$this->opciones = [
    'elementos' => [
        'Registrar' => ['Deportista/crear'],
    ]
];*/
?>
<?php $this->abrirSeccion("antes-de-opciones"); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="<?= Sis::crearUrl(['Deportista/generarReporte']) ?>" target="_blank">
        <?php
        $icon=  CBoot::fa('file-pdf-o');
        echo CBoot::boton('Generar pdf '.$icon,'primary',['id'=>'generar_pdf']);
        ?>
        </a>
    </div>
</div>
<div class="p-5"></div>
<?php $this->cerrarSeccion(); ?>

<?= $this->vistaP('_formularioFiltros', ['categorias' => $categorias, 'estados' => $estados, 'identificacion' => $identificacion,'nombre' => $nombre,'categoria' => $categoria,'estado' => $estado,]) ?>

<div class="table-responsive">
<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => false,
//    'filtrosAjax' => [
//        'identificacion',
//        'nombre1',
//        'categoria_id' => CBoot::select('', $categorias, ['defecto' => 'Categoría', 'style' => 'min-width: 150px;', 'name' => 'categoria_id']), 
//        'estado_id' => CBoot::select('', $estados, ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado_id'])
//        /*'estado_id' => CBoot::select('', [1 => 'Activo', 2 => 'Inactivo',
//            3 => 'Eliminado', 4 => 'Lista de Espera', 
//            5 => 'Sancionado', 6 => 'Retirado', 
//            7 => 'Prestado', 8 => 'Préstamo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado_id'])       */
//     ],
    'criterios' => $criterios,
    'modelo' => 'Deportista',
# id_deportista, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, foto, telefono1, telefono2, fecha_nacimiento, estado_id, tipo_documento_id
     'columnas' => [
        'identificacion',
        'nombre1' => 'nombreCompleto',
        'categoria_id' => 'NombreCategoria',
        'direccion',
        'telefono1',
        'telefono2',
        'fecha_nacimiento',
        'edad',
        'estado_id' => ['valor' => 'EtiquetaEstado', 'opciones' => ['class' => 'text-center']] 
    ],
    'opciones' => [
        ['i' => 'soccer-ball-o', 'url' => 'Deportista/fichaTecnica&{id:pk}'],
        ['i' => 'eye', 'url' => 'Deportista/ver&{id:pk}'],
        ['i' => 'pencil', 'url' => 'Deportista/editar&{id:pk}'],
        ['i' => 'refresh', 'url' => 'Deportista/cambiarEstado&{id:pk}'],
    ],
    'opciones' => false,
    'paginacion' => 10,
])
?>
</div>