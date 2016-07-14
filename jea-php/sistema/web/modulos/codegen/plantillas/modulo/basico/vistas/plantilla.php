<?php echo "<?php\n"; ?>
Sis::apl()->mRe->JQuery();
Sis::apl()->mRe->Bootstrap3();
Sis::apl()->mRe->AwesomeFont();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php echo "<?php echo Sis::apl()->charset; ?>"; ?>">
        <title><?php echo "<?php echo \$this->tituloPagina; ?>"; ?></title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="jumbotron">
                        <h1>Módulo <?php echo $nMod; ?></h1>
                    </div>
                    <?php echo "<?php echo \$this->contenido; ?>"; ?>
                </div>
            </div>    	
        </div>
    </body>
</html>
