<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Eventos' => ['Evento/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Evento/inicio'],
        ]
    ];    
    $this->tituloPagina = "Registrar evento";
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo,
        'TipoEvento' => $TipoEvento,
        'Estado' => $Estado,
        'Autor' => $Autor,
        'url' => $url,
        'imagenes' => $imagenes,
        'isEnable' => $bloquear? 'disabled' : 'enabled',
        ]); ?>
</div>
