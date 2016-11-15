<?php
$this->tituloPagina = "Ver Usuario";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Suscriptores' => ['Usuario/Suscriptores'],
    'Ver'
];
?>
<div class="tile p-15">
    <div class="row">
        <div class="col-sm-6">
              
            <div class="panel-heading text-center">
                
                <h4><?php echo $modelo->getNombreMasUsuario(); ?></h4>
            </div>
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th><?php echo $modelo->obtenerEtiqueta('nombres') ?></th>
                                <td><?php echo $modelo->nombres; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $modelo->obtenerEtiqueta('apellidos') ?></th>
                                <td><?php echo $modelo->apellidos; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $modelo->obtenerEtiqueta('rol_id') ?></th>
                                <td><?php echo $modelo->Rol->nombre; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $modelo->obtenerEtiqueta('nombre_usuario') ?></th>
                                <td><?php echo $modelo->nombre_usuario; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $modelo->obtenerEtiqueta('email') ?></th>
                                <td id="email"><?php echo $modelo->email; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $modelo->obtenerEtiqueta('telefono') ?></th>
                                <td><?php echo $modelo->telefono; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $modelo->obtenerEtiqueta('estado') ?></th>
                                <td><?php echo $modelo->EtiquetaEstado ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    
        <div class="col-sm-6">
            <div class="page-header">
                <h3>Escribir</h3> 
            </div>       
            <div class="form-group">
                <label for="">Asunto</label>
                <input type="text" id="asunto" class="form-control" placeholder="Ingrese el asunto del mensaje">
            </div>
            <div class="form-group">
                <p class="text-right"><span id="limite">0</span> / 200 Carácteres</p>
                <textarea placeholder="Ingrese el mensaje..." name="" id="msg" cols="30" rows="8" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button id="btn-send" class="btn btn-primary btn-block">
                    Enviar 
                    <i class="fa fa-send"></i>
                </button>
            </div>
        </div>

    </div>
</div>

<script>
    var limitSpn = $("#limite");

    $(function(){
        $("#msg").keyup(function(e){
            var txt = $(this);
            var total = txt.val().length;
            limitSpn.html(total);
        });
        $("#btn-send").click(function(){
            var txt = $("#msg");
            var total = txt.val().length;
            if(total > 200){
                lobiAlert("error", "Mensaje demasiado largo");
            } else {
                enviarMsg(txt.val());
            }
        });
    });

    function enviarMsg(msg){
        var email = $("#email").html();
        var asunto = $("#asunto").val();

        $.ajax({
            'url'   : '<?= Sis::crearUrl(['usuario/enviarEmailSuscriptor']) ?>',
            'type'  : 'POST',
            'data'  : {
                'ajxsnd': true,
                'email' : email,
                'msg'   : msg,
                'asunto': asunto,
            }
        }).done(function(data){
            if(data.error == true){
                lobiAlert("error", data.msg);
            } else if(data.error == false){
                lobiAlert("success", data.msg);
            } else {
                lobiAlert("Error inesperado");
                console.log(data);
            }
        });
    }
</script>