<?php 
Sis::Recursos()->recursoCss([
    'url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css',
]);
Sis::Recursos()->recursoJs([
    'url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js',
]);
Sis::Recursos()->recursoJs([
    'url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput_locale_es.js',
]);
 ?>

<div class="tile p-15 gallery">
	<div class="page-header">
		<div class="row" id="search-panel">
			<div class="col-sm-4">
				<div class="input-group">
					<?= CBoot::text('', ['id' => 'search', 'placeholder' => 'Buscar imagen']) ?>
					<div class="input-group-addon">
						<i class="fa fa-search"></i>
					</div>
					<div class="input-group-btn">
						<?= CBoot::boton('Buscar', 'default') ?>
					</div>					
				</div>
			</div>
			<div class="col-sm-4">
				<a href="#" id="btn-upload-img" class="btn btn-primary">¿Desea cargar una imagen?</a>
			</div>			
		</div>
	</div>
	<div class="image-gallery-container-wraper">		
		<div id="imgs-container" class="image-gallery-container">
			<?php foreach ($imagenes as $imagen): ?>
			<div id="img-gallery-<?= $imagen->id_imagen ?>" data-id="<?= $imagen->id_imagen ?>" class="gallery-manager" data-url="<?= Sis::urlBase() . 'publico/imagenes/galerias/' . $imagen->url ?>" data-date="<?= $imagen->fecha ?>" data-description="<?= $imagen->descripcion ?>">
				<img src="<?= Sis::urlBase() . 'publico/imagenes/galerias/thumbs/tmb_' . $imagen->url ?>" alt="">
				<p class="caption"><?= $imagen->titulo ?></p>
				<p class="label-view">Ver</p>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>

<div class="modal fade modal-wide" id="modal-view-img">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><span id="img-title"></span></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-8">
						<img id="img-preview" src="" alt="">
					</div>		
					<div class="col-sm-4">
						<table class="table table-bordered">
							<tr>
								<th>Fecha de subida: </th>
								<td id="img-date"></td>
							</tr>
							<tr>
								<th>Descripción: </th>
								<td>
									<?= CBoot::textArea("", ['id' => 'img-description']) ?>
								</td>
							</tr>
							<tr>
								<th>&nbsp;</th>
								<td>
									<?= CBoot::boton('Guardar ' . CBoot::fa('floppy-o'), 'success btn-block', ['id' => 'button-save']) ?>
								</td>
							</tr>
							<tr>
								<th>&nbsp;</th>
								<td>
									<?= CBoot::boton('Eliminar imagen ' . CBoot::fa('trash'), 'danger btn-block', ['id' => 'button-delete']) ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!-- modal cargar imagenes -->
<div class="modal fade modal-wide" id="upload-img">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cargar imagenes</h4>
			</div>
			<div class="modal-body">
				<input type="file" name="imagenes" id="cargar-imagen" multiple="">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function(){
		$("#btn-upload-img").click(function(){
			$("#upload-img").modal("show");
		});
		$(".gallery-manager").click(function(){
			mostrarImg($(this));
		});

		$("#button-save").click(function(){
			guardar($(this));
		});
		$("#button-delete").click(function(){
			borrar($(this));
		});

	    $(function(){
	        $("#cargar-imagen").fileinput({
	            language: 'es',
             	allowedFileExtensions: ['jpg', 'gif', 'png'],
	            uploadUrl: "<?= Sis::crearUrl(['publicacion/cargarImagenes']) ?>",
	            uploadAsync: true,
	            uploadExtraData: {
	                ajx: true,
	            },
	        }).on('fileuploaded', function(event, data, id, index){
	            var r = data.response;

	            if(r.uploadErr === false){
					// id, url, fecha, descripcion, titulo
					var caption = $("<p/>", {'class' : 'caption'});
					var label = $("<p/>", {'class' : 'label-view'});
					var img = $("<img/>", {src: r.url});
					var container = $("<div/>", {id : "img-gallery-" + r.img_id});

					container.addClass("gallery-manager")
						.attr("data-url", r.rurl)
						.attr("data-id", r.img_id)
						.attr("data-date", r.date)
						.attr("data-description", r.description);
					caption.html(r.title);
					label.html("Ver");

					container.append(img, caption, label);
	                container.click(function(){
	                	mostrarImg($(this));
	                });
	                
	                $("#imgs-container").prepend(container);
	            }
	                
	        });
	    });

	});

	function guardar(obj){
		doRequest(obj.attr("data-id"), "save");
	}

	function borrar(obj){
		confirmar("Confirmar", "Si se elimina esta imagen dejará de estar disponible en cualquier publicación que la use ¿Desea continuar?", function(){
			doRequest(obj.attr("data-id"), "delete");
		});
	}

	function doRequest(id, type){
		$.ajax({
			url: '<?= Sis::crearUrl(["publicacion/ajax"]) ?>',
			type: 'POST',
			data: {
				ajx: true,
				id : id,
				type: type,
				description : $("#img-description").val()
			}
		}).done(function(data){
			if(data.error == false){
				lobiAlert("success", data.msg);
				if(type == "delete"){
					$("#img-gallery-" + id).remove();
					$("#modal-view-img").modal("hide");
				}
			} else if(data.error == true){
				lobiAlert("error", data.msg);
			} else {
				console.log(data);
			}
		});
	}

	function mostrarImg(obj){
		var img = $("#img-preview");
		img.attr("src", obj.attr("data-url"));
		$("#img-date").html(obj.attr("data-date"));
		$("#img-description").val(obj.attr("data-description"));
		$("#modal-view-img").modal("show");
		$("#img-title").html(obj.find(".caption").html());
		$("#button-save").attr("data-id", obj.attr("data-id"));
		$("#button-delete").attr("data-id", obj.attr("data-id"));

	}
</script>