<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposEvento' => ['TipoEvento/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoEvento/inicio'],
            'Registrar' => ['TipoEvento/crear'],
            'Modificar' => ['TipoEvento/editar', 'id' => $modelo->id_tipo],
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
            </tbody>
        </table>

    </div>
</div>
