<?php 
/**
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.1
 */
    Sis::Recursos()->JQuery();
    Sis::Recursos()->Bootstrap3();
    $estilos = ".titulo-error{ color:red;}" .
            ".archivo-con-error{ font-weight: 600; }" .
            ".linea-codigo{" .
                "border-right: 1px solid black;".
                "padding-right: 10px;" .
                "margin-right: 20px;" .
            "}".
            ".linea-con-error{" .
                "background-color: #F9C8C8;" .
                "width: 100%;" .
                "display: block;" . 
            "}" .
            ".rastreo h4{" .
                "cursor: pointer;" .
                "border-radius: 2px;" .
                "transition: all 0.2s;" .
            "}" .
            ".rastreo h4:hover{" .
                "background-color: rgba(128, 0, 0, 0.2);" .
                "padding: 4px;" .
            "}";
    Sis::Recursos()->registrarEstilosCliente($estilos);
    $script = 'jQuery(".rastreo h4").click(function(){'.
                        'jQuery(this).parent().find(".archivo-rastreo").slideToggle();'.
                    '});';
    Sis::Recursos()->registrarScriptCliente($script, CMRecursos::POS_READY);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?= Sis::apl()->charset; ?>" />
        <title><?= $this->titulo; ?></title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <h1 class="titulo-error"><?= $this->titulo; ?> <small><?= $this->getTipoError($this->no); ?></small></h1>
                </div>
                <div class="well">
                    <?= $this->mensaje; ?>
                </div>
                <p class="archivo-con-error"><?= $this->archivo; ?> <span class="badge"><?= $this->linea; ?></span></p>
                <?php 
                echo $this->verError($this->archivo, $this->linea);
                ?>
                <h3 class="titulo-rastreo">Rastreo del error</h3>
                <?php foreach($this->rastreo AS $rastro): ?>
                <div class="rastreo">
                    <h4>#<?= ++ $conteo; ?> <small><?= $rastro['file']; ?></small></h4>
                    <div class="archivo-rastreo" style="display: none;">
                        <?= $this->verError($rastro['file'], $rastro['line']); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
