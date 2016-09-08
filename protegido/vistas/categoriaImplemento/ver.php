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
        'Registrar' => ['CategoriaImplemento/crear'],
        'Actualizar' => ['CategoriaImplemento/editar', 'id' => $modelo->id_categoria],
    ]
];
?>
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre') ?></th>
                    <td><?php echo $modelo->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?php echo $modelo->descripcion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->EtiquetaEstado; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
