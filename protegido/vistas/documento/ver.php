<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Documentos' => ['Documento/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Documento/inicio'],
            'Crear' => ['Documento/crear'],
            'Modificar' => ['Documento/editar', 'id' => $modelo->id_documento],
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
                    <th><?php echo $modelo->obtenerEtiqueta('id_documento') ?></th>
                    <td><?php echo $modelo->id_documento; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('url') ?></th>
                    <td><?php echo $modelo->url; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('titulo') ?></th>
                    <td><?php echo $modelo->titulo; ?></td>
                </tr>
                <tr>
                    <th><?php echo $modelo->obtenerEtiqueta('tipo_id') ?></th>
                    <td><?php echo $tiposDocumentos["$modelo->tipo_id"] . " (Id: $modelo->tipo_id)"; ?></td>
                </tr>
<!--                <tr>
                    <th><?php #echo $modelo->obtenerEtiqueta('papelera') ?></th>
                    <td><?php #echo $modelo->papelera; ?></td>
                </tr>-->
            </tbody>
        </table>

    </div>
</div>
