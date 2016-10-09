<?php 
    $this->tituloPagina = "Ver Tipo de Identificación";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Tipos de Identificación' => ['TipoIdentificacion/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoIdentificacion/inicio'],
            'Registrar' => ['TipoIdentificacion/crear'],
            'Actualizar' => ['TipoIdentificacion/editar', 'id' => $modelo->id_tipo_documento],
        ]
    ];
?>
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('nombre') ?></th>
                    <td><?php echo $modelo->nombre; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('abreviatura') ?></th>
                    <td><?php echo $modelo->abreviatura; ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
