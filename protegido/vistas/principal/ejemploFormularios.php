<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Ejemplo'
    ];
    
    $this->opciones = [
        'elementos' => [
            'opcion1' => ['principal/ejemplo'],
            'opcion2' => ['principal/ejemplo'],
            'opcion3' => ['principal/ejemplo'],
        ]
    ];
    
$f = new CBForm(['id' => 'ejemplo']);
$f->abrir();
    
?>
    
<div class="form-group">
    <label>Campo 1</label>
    <input class="form-control" placeholder="Ejemplo">
</div>
<div class="form-group">
    <label>Campo 2</label>
    <input class="form-control" placeholder="Ejemplo">
</div>
<div class="form-group">
    <label>Campo 3</label>
    <input class="form-control" placeholder="Ejemplo">
</div>

<?php $f->cerrar(); ?>
