<?php
/**
 * Esta clase es la encargada de manipular y generar las rutas de la aplicación
 * @package manejadores
 * @author Jorge Alejandro Quiroz Serna (jako) <alejo.jko@gmail.com>
 * @version 1.0.1
 * @copyright (c) 2015, jakop
 */

class CMRutas {
    /**
     * Nombre del servidor ej: localhost, miDominio.com
     * @var string 
     */
    private $httpHost;
    /**
     * Otra manera de obtener el nombre del servidor
     * @var type 
     */
    private $nombreServidor;
    /**
     * Protocolo usado y su correspondiente versión, ejemplo: HTTP/1.1
     * @var string 
     */
    private $protocoloServidor;
    /**
     * Ubicación de la carpeta publica del servidor
     * @var string 
     */
    private $raizServidor;
    /**
     *
     * @var string 
     */
    private $esquemaSolicitado;
    /**
     * Dirección de email del admin del servidor
     * @var string 
     */
    private $emailAdmin;
    /**
     * Archivo al que se hace llamado en la url
     * @var string 
     */
    private $scriptSolicitado;
    /**
     * Manera corta del archivo llamado en la url
     * @var string 
     */    
    private $peticionUri;
    /**
     * Puerto a travez del cual se establece la conexión
     * @var string
     */
    private $puerto = '80';
    private $server;
    private $get;
    
    public function __construct() {
//        var_dump($_SERVER);exit();
        /**
         * En algunos servidores no se defininen algunas variables, por lo
         * que podría explotar este manejador si no encuentra dichas variables
         */
        try {
            $this->server = filter_input_array(INPUT_SERVER);
            $this->get = filter_input_array(INPUT_GET);
            $this->inicializar($this->server);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            Sis::fin();
        }
    }
    
    /**
     * Esta función inicializa todos los valores de la clase
     * @param array $sc super global $_SERVER
     */
    private function inicializar($sc){
        $this->httpHost = $sc['HTTP_HOST'];
        $this->nombreServidor = $sc['SERVER_NAME'];
        $this->protocoloServidor = $sc['SERVER_PROTOCOL'];
        $this->raizServidor = $sc['DOCUMENT_ROOT'];        
        $e = $sc['SERVER_PROTOCOL'];                                            // usamos esta variable para hayar el esquema
        $this->esquemaSolicitado = strtolower(substr($e, 0, strpos($e, '/')));
        $this->emailAdmin = $sc['SERVER_ADMIN'];
        $this->scriptSolicitado = $sc['SCRIPT_FILENAME'];
        $this->peticionUri = $sc['REQUEST_URI'];
        $this->puerto = $sc['SERVER_PORT'];
    }
    
    /**
     * Esta función construye la url base de la aplicación
     * @return string
     */
    public function getUrlBase(){
        $carpeta = dirname(str_replace($this->raizServidor, '', $this->scriptSolicitado));
        $servidor = $this->nombreServidor . ($this->puerto == '80'? '' : ":$this->puerto");
        $tmp = $servidor. '/' .
                str_replace('index.php', '', $carpeta) . '/';
        $url = $this->esquemaSolicitado.'://'.preg_replace("/\/{2,}/", '/', $tmp);
        /**********************************************************
         *  si hay parametros en get hay que limpiarlos de la url *
         **********************************************************/
        if($this->get != null){
            $url = strtok($url,'?');
        }
        return $url;
    }
    
    /**
     * Esta función retorna la ruta base de la aplicación que se ejecuta
     * @return string
     */
    public function getRutaBase(){
        return realpath(dirname($this->scriptSolicitado));
    }
    
    /**
     * Esta función permite creaer url con base en una ruta o solicitud de
     * un controlador
     * @param array $ruta
     * @return string
     */
    public function crearUrl($ruta = array()){
        if(gettype($ruta) == 'string'){ return $ruta; }
        if(count($ruta) == 0){
            return $this->getUrlBase();
        }
        $peticion = $ruta[0];
        unset($ruta[0]);
        
        /******************************************************
         * construimos los parametros para la url, los cuales *
         * son codificados para que la url tenga formato      *
         ******************************************************/
        $parametros = implode('&', 
                    array_map(
                        function($n, $v){ return $n.'='. rawurlencode($v); }, 
                        array_keys($ruta),
                        $ruta
                    )
                );
        if(Sis::ap()->apacheRewrite){
            return $this->getUrlBase()
                    .$peticion
                    .($parametros != ''? '?'.$parametros : '');
        } else {            
            return $this->getUrlBase().'?r='
                    .$peticion
                    .($parametros != ''? '&'.$parametros : '');
        }
    }
    
    /**
     * Esta función retorna el nombre del servidor donde se ejecuta la aplicación
     * @return string
     */
    public function getDominio(){
        return $this->esquemaSolicitado.'://'.$this->httpHost;
    }
    
    /**
     * Esta función retorna la raíz del servidor
     * @return string
     */
    public function getRaizServidor(){
        return $this->raizServidor;
    }
}