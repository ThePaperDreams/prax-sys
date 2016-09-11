<?php
$this->tituloPagina = "Listar Deportistas";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas'
];

$this->opciones = [
    'elementos' => [
        'Registrar' => ['Deportista/crear'],
    ]
];
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
<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'identificacion',
        'nombre1',
        'telefono1', 
        'estado_id' => CBoot::select('', $estados, ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado_id'])
        /*'estado_id' => CBoot::select('', [1 => 'Activo', 2 => 'Inactivo',
            3 => 'Eliminado', 4 => 'Lista de Espera', 
            5 => 'Sancionado', 6 => 'Retirado', 
            7 => 'Prestado', 8 => 'Préstamo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado_id'])*/        
     ],
    'criterios' => ['order' => 'estado_id=1 DESC, t.id_deportista DESC'],
    'modelo' => 'Deportista',
# id_deportista, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, foto, telefono1, telefono2, fecha_nacimiento, estado_id, tipo_documento_id
     'columnas' => [
        'identificacion',
        'nombre1' => 'nombreCompleto',
        'telefono1',
        'estado_id' => ['valor' => 'EtiquetaEstado', 'opciones' => ['class' => 'text-center']] 
    ],
    'opciones' => [
        ['i' => 'soccer-ball-o', 'url' => 'Deportista/fichaTecnica&{id:pk}', 'title' => 'Ficha técnica'],
        ['i' => 'eye', 'url' => 'Deportista/ver&{id:pk}', 'title' => 'Ver'],
        ['i' => 'pencil', 'url' => 'Deportista/editar&{id:pk}', 'title' => 'Editar'],
        ['i' => 'refresh', 'url' => 'Deportista/cambiarEstado&{id:pk}', 'title' => 'Cambiar estado'],
    ],
    'paginacion' => 10,
])
?>