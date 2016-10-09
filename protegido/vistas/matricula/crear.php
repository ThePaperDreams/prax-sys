<?php 
    $this->tituloPagina = "Matricular Deportista";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Matriculas' => ['Matricula/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Ver matriculas' => ['Matricula/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'deportistas' => $deportistas, 'categorias' => $categorias]); ?>
</div>
