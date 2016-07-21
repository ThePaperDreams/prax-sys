<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposDocumento' => ['TipoDocumento/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoDocumento/inicio'],
            'Crear' => ['TipoDocumento/crear'],
            'Modificar' => ['TipoDocumento/editar', 'id' => $modelo->id_tipo],
        ]
    ];
?>
<div class="col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('id_tipo') ?></th>
                    <td><?php echo $modelo->id_tipo; ?></td>
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
                    <th><?php echo $modelo->obtenerEtiqueta('padre_id') ?></th>
                    <td><?php echo ($modelo->padre_id != 0) ? $tiposDocumentos["$modelo->padre_id"] . " (Id: $modelo->padre_id)" : ""; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
