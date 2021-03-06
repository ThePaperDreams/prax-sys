<?php echo "<?php\n"?>
/**
 * Este modelo es la representación de la tabla <?php echo $tabla."\n" ?>
 *
 * Atributos del modelo
<?php 
foreach($atributos AS $atr){
  echo " * @property " . $this->obtenerTipo($atr['Type']) . " \$" .$atr['Field'] . "\n";
}
?>
 * 
 * Relaciones del modelo
 */
 class <?php echo $nClase ?> extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "<?php echo $nTabla?>";
    }

    /**
     * Esta función retorna los atributos de la tabla <?php echo $tabla . "\n" ?>
     * @return array
     */
    public function atributos() {
        return [<?php 
            echo "\n";
            foreach($atributos AS $atr) {
                $pk = $atr['Key'] == 'PRI'? 
                        " => ['pk'] " : '';
                $def =  $atr['Default'] != ''? 
                        " => ['def' => '" . $atr['Default'] . "'] " : '';
                echo "\t\t'" . $atr['Field'] . "'" . $pk . $def . ", \n";
            }
            ?>
        ];
    }
    
    /**
     * Esta función retorna las relaciones con otros modelos
     * @return array
     */
    protected function relaciones() {        
        return [
            # el formato es simple: 
            # tipo de relación | modelo con que se relaciona | campo clave foranea
            <?php foreach($relaciones AS $rel){
                $nombreRel = $this->nombreRelacion($rel['fk_name']);
                $campoFk = $rel['foreign_key_column'];
                echo "\t'" . lcfirst($nombreRel) . "' => [self::PERTENECE_A, '$nombreRel', '$campoFk'],\n";
            }
            ?>
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [<?php 
            echo "\n";
            foreach($atributos AS $atr) {
                $etiqueta = ucwords(str_replace('_', ' ', $atr['Field']));
                echo "\t\t'" . $atr['Field'] . "' => '$etiqueta', \n";
            }
            ?>
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return <?php echo $nClase . "\n" ?>
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return <?php echo $nClase . "\n" ?>
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return <?php echo $nClase . "\n" ?>
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo <?php echo "$tabla\n" ?>
     * @param string $clase
     * @return <?php echo $nClase . "\n" ?>
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}
