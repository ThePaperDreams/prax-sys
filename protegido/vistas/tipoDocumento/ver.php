<?php 
    $this->tituloPagina = "Ver Tipo de Documento";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Tipos de Documentos' => ['TipoDocumento/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoDocumento/inicio'],
            'Registrar' => ['TipoDocumento/crear'],
            'Actualizar' => ['TipoDocumento/editar', 'id' => $modelo->id_tipo],
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
                    <th><?php echo $modelo->obtenerEtiqueta('descripcion') ?></th>
                    <td><?php echo $modelo->descripcion; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('padre_id') ?></th>
                    <td><?php echo $modelo->NombrePadre; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
