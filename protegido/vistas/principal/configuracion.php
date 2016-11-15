<?php 
Sis::Recursos()->RecursoJS(['url' => Sis::Recursos()->getUrlRecursos().'librerias/tinyMce/tinymce.js']);

$this->tituloPagina = "Configuración Global";
$this->migas = [
	'Home' => ['principal/inicio'],
	'Configuración'
];	
 ?>

 <div class="col-sm-12">
 	<div class="row">
 		<div class="col-sm-12"> 			
		 	<div class="tile p-15">		 	

			 	<div class="page-header">
			 		<h4>General</h4>
			 	</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="">E-mail Administrador</label>
						<div class="input-group">
							<input type="text" class="form-control" id="email-admin" value="<?= Configuracion::get('email_admin') ?>">
							<div class="input-group-addon">
								<i class="fa fa-envelope"></i>
							</div>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label for="">Calendario de eventos</label>
						<br>
						<input type="checkbox" name="my-checkbox" checked id="check">
					</div>
				</div>

				<div class="page-header">
					<h4>Sitio web</h4>
				</div>

				<div class="form-group">
					<label for="">Quienes somos</label>
					<textarea name="contenido_publicacion" id="Publicaciones_contenido" cols="30" rows="15" class="form-control"><?= Configuracion::get("quienes_somos") ?></textarea>
				</div>

				<div class="page-header">
					<h3>Redes sociales</h3>
				</div>
				<div class="form-group col-sm-3">
					<label for="">Facebook</label>
					<div class="input-group">
						<input name="redes[facebook]" type="text" class="form-control" value="<?= Configuracion::get('redes_facebook') ?>">
						<div class="input-group-addon">
							<i class="fa fa-facebook"></i>
						</div>
					</div>
				</div>
				<div class="form-group col-sm-3">
					<label for="">Twitter</label>
					<div class="input-group">
						<input name="redes[twitter]" type="text" class="form-control" value="<?= Configuracion::get('redes_twitter') ?>">
						<div class="input-group-addon">
							<i class="fa fa-twitter"></i>
						</div>
					</div>
				</div>
				<div class="form-group col-sm-3">
					<label for="">Instagram</label>
					<div class="input-group">
						<input name="redes[instagram]" type="text" class="form-control" value="<?= Configuracion::get('redes_instagram') ?>">
						<div class="input-group-addon">
							<i class="fa fa-instagram"></i>
						</div>
					</div>
				</div>
				<div class="form-group col-sm-3">
					<label for="">Youtube</label>
					<div class="input-group">
						<input name="redes[youtube]" type="text" class="form-control" value="<?= Configuracion::get('redes_youtube') ?>">
						<div class="input-group-addon">
							<i class="fa fa-youtube"></i>
						</div>
					</div>
				</div>

				<hr>

				<div class="page-header">
					<h4>Maestras</h4>
				</div>
				<div class="list-group">
					<a href="<?= Sis::crearUrl(['TipoDocumento/inicio']) ?>" class="list-group-item">Tipos de Documento</a>
					<a href="<?= Sis::crearUrl(['EstadoDeportista/inicio']) ?>" class="list-group-item">Estados de Deportista</a>
					<a href="<?= Sis::crearUrl(['TipoIdentificacion/inicio']) ?>" class="list-group-item">Tipos de Identificación</a>
				</div>
				<div class="row">
					<div class="col-sm-offset-4 col-sm-4">
						<button class="btn-primary btn btn-block">
							Guardar <i class="fa fa-floppy-o"></i>
						</button>
					</div>
				</div>
			 </div> 		
 		</div>
 	</div>
 	<!-- fin general -->
 	
 </div>

 <div class="col-sm-6">
 	<div class="row">
 		<div class="col-sm-12"> 			
	 		<div class="tile p-15">
	 			
	 			<div class="page-header">
			 		<h4>Desarrollador</h4>
			 	</div>


				<div class="form-group">
					<label for="">Url sitio aplicación</label>
					<div class="input-group">
						<input type="text" class="form-control" id="email-admin" value="<?= Configuracion::get(	'url_app') ?>">
						<div class="input-group-addon">
							<i class="fa fa-cubes"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="">Ruta aplicación</label>
					<div class="input-group">
						<input type="text" class="form-control" id="email-admin" value="<?= Configuracion::get(	'ruta_app') ?>">
						<div class="input-group-addon">
							<i class="fa fa-cubes"></i>
						</div>
					</div>
				</div>

			 	<div class="form-group">
					<label for="">Url sitio web</label>
					<div class="input-group">
						<input type="text" class="form-control" id="email-admin" value="<?= Configuracion::get('url_sitio_web') ?>">
						<div class="input-group-addon">
							<i class="fa fa-globe"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="">Ruta sitio web</label>
					<div class="input-group">
						<input type="text" class="form-control" id="email-admin" value="<?= Configuracion::get(	'ruta_sitio') ?>">
						<div class="input-group-addon">
							<i class="fa fa-globe"></i>
						</div>
					</div>
				</div>		
				
				<hr>

				<div class="page-header">
					<h4>Maestras</h4>
				</div>

				<div class="list-group">
					<a href="<?= Sis::crearUrl(['Ruta/inicio']) ?>" class="list-group-item">Rutas</a>
					<a href="<?= Sis::crearUrl(['Opmenu/inicio']) ?>" class="list-group-item">Opciones de Menú</a>
				</div>
				<!-- tmp -->

	 		</div>
 		</div>
 	</div>
 	<!-- fin desarrollador -->
 </div>

 <script>
 	
 	$(function(){
 		$("#check").bootstrapSwitch({
 			onText: 'Si',
 			offText: 'No',
 		});
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