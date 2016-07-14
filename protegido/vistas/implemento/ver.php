<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Implementos' => ['Implemento/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Implemento/inicio'],
            'Crear' => ['Implemento/crear'],
            'Modificar' => ['Implemento/editar', 'id' => $modelo->id_implemento],
        ]
    ];
?>
<div class="col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('id_implemento') ?></th>
                    <td><?php echo $modelo->id_implemento; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('categoria_id') ?></th>
                    <td><?php echo $modelo->categoria_id; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre') ?></th>
                    <td><?php echo $modelo->nombre; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?php echo $modelo->descripcion; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('unidades') ?></th>
                    <td><?php echo $modelo->unidades; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('minimo_unidades') ?></th>
                    <td><?php echo $modelo->minimo_unidades; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('maximo_unidades') ?></th>
                    <td><?php echo $modelo->maximo_unidades; ?></td>
                </tr>
                            </tbody>
        </table>

    </div>
</div>
