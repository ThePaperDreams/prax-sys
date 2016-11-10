<?php 
Sis::Recursos()->RecursoJS(['url' => Sis::Recursos()->getUrlRecursos().'librerias/tinyMce/tinymce.js']);

$this->migas = [
	'Inicio' => ['principal/inicio'],
	'Publicaciones' => ['publicacion/inicio'],
	'Configuración' => ['publicacion/configuracion'],
	'Configuración del sitio web',
];


// $this->opciones = [
// 	'elementos' => [
// 		'Configuración' => ['publicacion/configuracion'],
// 	]
// ];

$this->tituloPagina

?>

<div class="tile p-15">
	<form action="" method="POST">
		<div class="row">
			<div class="col-sm-8">
				<h3>Quienes somos</h3>
				<hr>
				<div class="form-group">
					<textarea name="contenido_publicacion" id="Publicaciones_contenido" cols="30" rows="5" class="form-control"><?= Configuracion::get("quienes_somos") ?></textarea>
				</div>
			</div>
			<div class="col-sm-4">
				<h3>Redes sociales</h3>
				<hr>
				<div class="form-group">
					<label for="">Facebook</label>
					<input name="redes[facebook]" type="text" class="form-control" value="<?= $facebook ?>">
				</div>
				<div class="form-group">
					<label for="">Twitter</label>
					<input name="redes[twitter]" type="text" class="form-control" value="<?= $twitter ?>">
				</div>
				<div class="form-group">
					<label for="">Instagram</label>
					<input name="redes[instagram]" type="text" class="form-control" value="<?= $instagram ?>">
				</div>
				<div class="form-group">
					<label for="">Youtube</label>
					<input name="redes[youtube]" type="text" class="form-control" value="<?= $youtube ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-offset-8 col-sm-4">
						<button class="btn btn-primary btn-block">
							Guardar 
							<i class="fa fa-floppy-o"></i>
						</button>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
	$(function(){
        tinymce.init({
            selector: '#Publicaciones_contenido',
            language : 'es',
            plugins: "code,image,pagebreak,advlist,fullscreen,imagetools,link,media,paste,textcolor,wordcount,example,",
            image_advtab: true,
            image_prepend_url: "<?php echo Sis::UrlBase() ?>/imagenes/articulos",
            link_assume_external_targets: true
        });
	});
</script>