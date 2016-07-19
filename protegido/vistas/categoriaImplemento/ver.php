<?php
$this->tituloPagina="Ver categoría de implementos";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar categoría de implementos' => ['CategoriaImplemento/inicio'],
    'Ver categoría de implementos'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['CategoriaImplemento/inicio'],
        'Crear' => ['CategoriaImplemento/crear'],
        'Modificar' => ['CategoriaImplemento/editar', 'id' => $modelo->id_categoria],
    ]
];
?>
<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre') ?></th>
                    <td><?php echo $modelo->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?php echo $modelo->descripcion; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
