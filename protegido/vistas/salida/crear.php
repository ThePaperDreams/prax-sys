<?php
$this->tituloPagina = "Registrar préstamo de implementos";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar salida de implementos' => ['Salida/inicio'],
    'Crear salida de implementos'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Salida/inicio'],
    ]
];
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'usuarios' => $usuarios]); ?>
</div>
