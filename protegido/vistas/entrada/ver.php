<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Entradas' => ['Entrada/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Entrada/inicio'],
            'Crear' => ['Entrada/crear'],
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
                    <th><?php echo $modelo->obtenerEtiqueta('id_entrada') ?></th>
                    <td><?php echo $modelo->id_entrada; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('fecha_realizacion') ?></th>
                    <td><?php echo $modelo->fecha_realizacion; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?php echo $modelo->descripcion; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('responsable_id') ?></th>
                    <td><?php echo $modelo->Usuario->nombres; ?></td>
                </tr>
                                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                    <td><?php echo $modelo->estado; ?></td>
                </tr>
                            </tbody>
        </table>

    </div>
</div>
