<?php 
$this->tituloPagina = "Cargar imagenes";
$this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Publicaciones' => ['Publicacion/inicio'],
        'Cargar imagen',
    ];

Sis::Recursos()->recursoCss([
    'url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css',
]);
Sis::Recursos()->recursoJs([
    'url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js',
]);

?>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#listar" aria-controls="listar" role="tab" data-toggle="tab">Listar</a></li>
    <li role="presentation"><a href="#cargar" aria-controls="cargar" role="tab" data-toggle="tab">Cargar</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="listar">
            <div class="form-group">
                <input type="file" name="imagenes" id="cargar-imagen" multiple="">
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="cargar">
            <div class="row" id="tab-imagenes">
               <?php foreach($imagenes AS $imagen): ?> 
                <div class="col-xs-2 col-md-2">
                    <a href="#" class="thumbnail">
                        <img src="<?= Sis::UrlBase() . "/publico/imagenes/publicaciones/thumbs/tmb_$imagen->url" ?>">
                    </a>
                </div>
                <?php endforeach ?>
            </div>
        </div>
  </div>

</div>

<script>
    $(function(){
        $("#cargar-imagen").fileinput({
            uploadUrl: "<?= Sis::crearUrl(['publicacion/cargarImagenes']) ?>",
            uploadAsync: true,
            uploadExtraData: {
                ajx: true,
            }
        }).on('fileuploaded', function(event, data, id, index){
            var respuesta = data.response;
            if(respuesta.uploadErr === false){
                var html = '<div class="col-xs-2 col-md-2">' + 
                    '<a href="#" class="thumbnail">' +
                        '<img src="' + respuesta.url + '">' +
                    '</a>' +
                '</div>';
                $("#tab-imagenes").append(html);
            }
                
        });
    });
</script>

