<?php 
$this->tituloPagina="Implementos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Implementos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['Implemento/crear'],
        ]
    ];
?>
<?php $this->abrirSeccion("antes-de-opciones") ?>

<div class="row">
    <div class="col-lg-6">
        <a href="<?= Sis::crearUrl(['implemento/generarReporte']) ?>" target="_blank">
            <?php
            $icon = CBoot::fa('file-pdf-o');
            echo CBoot::boton('Generar pdf ' . $icon, 'primary', ['id' => 'generar_pdf']);
            ?>
        </a>
    </div>
</div>
<div class="p-5"></div>

<?php $this->cerrarSeccion() ?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'categoria_id',
        'nombre', 
        'estado_id' => CBoot::select('', [1 => 'Activo', 2 => 'Inactivo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado_id']),
        'unidades',
        'minimo_unidades',
        'maximo_unidades', 
     ],
    'modelo' => 'Implemento',
    'criterios' => ['order' => "estado_id=1 desc"],
    # id_implemento, categoria_id, nombre, descripcion, unidades, minimo_unidades, maximo_unidades
    'columnas' => [  
        "categoria_id"=>"Categoria->nombre",
        "nombre" => 'NombreEstado',
        'estado_id' => 'EtiquetaEstado',
        "maximo_unidades",
        "unidades",
        "minimo_unidades",
    ],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver','url' => 'Implemento/ver&{id:pk}'],
        ['i' => 'pencil', 'title' => 'Actualizar', 'url' => 'Implemento/editar&{id:pk}', 'visible' => '$m->getEnPrestamo() == false'],
        ['i' => 'refresh', 'title' => 'Cambiar estado','url' => 'Implemento/anular&{id:pk}', 'visible' => '$m->getEnPrestamo() == false'],
    ],
    'paginacion' => 10,
]) ?>