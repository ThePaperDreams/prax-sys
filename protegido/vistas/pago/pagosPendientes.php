<?php 
$this->tituloPagina="Pagos pendientes";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Pagos pendientes',
    ];
    
    $this->opciones = [
        'elementos' => [
            'Consultar pagos' => ['pago/consultar'],
        ]
    ];
?>
<div class="tile p-15">
    <div class="row">
        <div class="form-group">
            <?= CBoot::select('', $deportistas, ['id' => 'cmb-deportistas', 'defecto' => 'seleccione un deportista', 'data-s2' => true]) ?> 
        </div> 
    </div>
    <div class="row">
<!--        <div class="col-sm-4">
            <?= CBoot::textAddOn('', ['pos' => CBoot::fa('calendar')]) ?>
        </div>
        <div class="col-sm-4">
            <?= CBoot::textAddOn('', ['pos' => CBoot::fa('calendar')]) ?>
        </div>
        <div class="col-sm-4">
            <?= CBoot::boton('Filtrar ' . CBoot::fa('filter'), 'primary btn-block') ?>
        </div>-->
    </div>
    <hr>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> Concepto </th>
                    <th>Fecha</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody id="pagos-pendientes">
                
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function(){
        $("#cmb-deportistas").change(function(){
            consultarPagos($(this).val());
        });
    });
    function consultarPagos(idDeportista){
        if(idDeportista === ""){ return; }
        $.ajax({
            'type' : 'POST',
            'url' : '<?= Sis::crearUrl(['Pago/pagosPendientes']) ?>',
            'data' : {
                ajaxSearch: true,
                idDep: idDeportista,
            }, 
            'success': function(respuesta){
                if(respuesta.error === false){
                    $("#pagos-pendientes").html(respuesta.html);
                } else {
                    console.log("error al consultar pagos pendientes");
                }
            }
        });
    }
</script>