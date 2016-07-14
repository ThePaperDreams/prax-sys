<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Asistencia' => ['Asistencia/inicio'],
    'Ver'
];
?>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('fecha') ?></th>
                    <td><?= $modelo->fecha; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('novedad') ?></th>
                    <td><?= $modelo->novedad; ?></td>
                </tr>
                <tr>
                    <th><?= $modelo->obtenerEtiqueta('realizada_por') ?></th>
                    <td><?= $modelo->Usuario->nombreMasUsuario; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Categoría: <strong><?= $modelo->Categoria->nombre ?></strong>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Deportista</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($asistencias AS $asistencia): ?>
                <?php if($modelo->validarFechaMatricula($asistencia->fecha_matricula)): ?>                
                    <?php if($asistencia->asistencia_id != null): ?>
                <tr class="danger">
                    <td><?= $asistencia->nombre_completo ?></td>
                    <td class="col-sm-1 text-center">
                        <?php if($asistencia->justificacion == null): ?>
                        <button class="btn btn-default btn-justificar" data-id="<?= $asistencia->id_fm ?>">Justificar</button>
                        <?php else: ?>
                        <button class="btn btn-primary" data-j="<?= $asistencia->justificacion ?>" onclick="mostrarJustificacion($(this))">Ver justificación</button>
                        <?php endif ?>
                    </td>
                </tr>
                    <?php else: ?>
                <tr class="success">
                    <td><?= $asistencia->nombre_completo ?></td>
                    <td class="col-sm-1 text-center"><span class="label label-success">Asistió</span></td>
                </tr>
                    <?php endif ?>
                <?php else: ?>
                <tr class="row-disabled">
                    <td><?= $asistencia->nombre_completo ?></td>
                    <td class="col-sm-1 text-center">
                        <span class="label label-default">No matriculado</span>
                    </td>
                </tr>                
                <?php endif ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function(){
        $(".btn-justificar").click(function(){
            openJustificar($(this));
        });
    });
    
    function openJustificar(obj){
        obj.justificarFalta({
            url: '<?= Sis::CrearUrl(['asistencia/ajx']) ?>',
            callback: function(r){
                Lobibox.notify(r.tipo,{
                    size: 'mini',
                    showClass: 'bounceInRight',
                    hideClass: 'bounceOutRight',
                    msg: r.msg,
                    delay: 8000,
                    soundPath: '<?= Sis::Recursos()->getUrlRecursos() ?>librerias/lobibox/sounds/',
                });
                if(!r.error){
                    cambiarBoton(obj,r.j);
                }
            },
            data: {
                'id': obj.attr('data-id'),
                'ajx': true,
                'r': 'justificar',
            }
        });
    }
    
    function cambiarBoton(obj, j){
        obj.removeClass('btn-default');
        obj.addClass('btn-primary');
        obj.text("Ver Justificación");
        obj.unbind("click");
        obj.attr("data-j", j);
        obj.click(function(){ mostrarJustificacion(obj); });
    }
    function mostrarJustificacion(obj){        
        Lobibox.alert('info',{
            msg: obj.attr("data-j"),
        });
    }
    
</script>