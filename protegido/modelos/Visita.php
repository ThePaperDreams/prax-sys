<?php
/**
 * Este modelo es la representación de la tabla tbl_visitas
 *
 * Atributos del modelo
 * @property int $id
 * @property int $publicacion_id
 * @property int $vistas
 * @property string $fecha
 * 
 * Relaciones del modelo
 * @property FkVisitasPublicaciones $fkVisitasPublicaciones
 */
 class Visita extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "visitas";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_visitas
     * @return array
     */
    public function atributos() {
        return [
            'id' => ['pk'] ,
                'publicacion_id',
                'vistas',
                'fecha',
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
            	'fkVisitasPublicaciones' => [self::PERTENECE_A, 'FkVisitasPublicaciones', 'publicacion_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id' => 'Id', 
		'publicacion_id' => 'Publicacion Id', 
		'vistas' => 'Vistas', 
		'fecha' => 'Fecha', 
        ];
    }

    public static function getDataDash(){
        $fechaIni = date("Y-m-01");
        $fechaFin = date("Y-m-t");

        $dias = intval(date('t'));        

        $sql = "SELECT ". 
                    "SUM(t.vistas) AS total, " . 
                    "t.fecha " .
                "FROM " . 
                    "tbl_visitas t " . 
                    "WHERE t.fecha BETWEEN '$fechaIni' AND '$fechaFin' " . 
                "GROUP BY fecha";
        $r = Sis::apl()->bd->ejecutarComando($sql, true);
        
        $respuesta = [
            'labels' => [],
            'data' => [],
        ];
        $fechas = [];

        foreach($r AS $v){ $fechas[$v->fecha] = $v; }

        for($i = 1; $i <= $dias; $i ++){

            $fecha = date("Y-m") . "-" . ($i < 10? '0' : '') . $i;
            $valor = 0;
            if(array_key_exists($fecha, $fechas)){ $valor = $fechas[$fecha]->total; }            
            $respuesta['labels'][] = "'$fecha'";
            $respuesta['data'][] = $valor;

        }   

        // pre($respuesta, $r);
        // exit();
        // foreach($resultados AS $v){
        //     $respuesta['labels'][] = "'$v->fecha'";
        //     $respuesta['data'][] = $v->total;
        // }

        return $respuesta;
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Visita
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Visita
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Visita
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_visitas
     * @param string $clase
     * @return Visita
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}