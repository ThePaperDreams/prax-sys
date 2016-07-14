<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Categorias' => ['Categoria/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Categoria/inicio'],
            'Crear' => ['Categoria/crear'],
            'Modificar' => ['Categoria/editar', 'id' => $modelo->id_categoria],
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
                    <th><?php echo $modelo->obtenerEtiqueta('id_categoria') ?></th>
                    <td><?php echo $modelo->id_categoria; ?></td>
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
                    <th><?php echo $modelo->obtenerEtiqueta('cupo_maximo') ?></th>
                    <td><?php echo $modelo->cupo_maximo; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('cupo_minimo') ?></th>
                    <td><?php echo $modelo->cupo_minimo; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('tarifa') ?></th>
                    <td><?php echo $modelo->tarifa; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('edad_minima') ?></th>
                    <td><?php echo $modelo->edad_minima; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('edad_maxima') ?></th>
                    <td><?php echo $modelo->edad_maxima; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->estado; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('entrenador_id') ?></th>
                    <td><?php echo $modelo->entrenador_id; ?></td>
                </tr>
                            </tbody>
        </table>

    </div>
</div>
