<?php
/**
 * Esta clase representa la aplicación que corre en el sistema
 * 
 * @package sistema.web
 * @author Jorge Alejandro Quiroz Serna (jako) <alejo.jko@gmail.com>
 * @version 1.0.7
 * @copyright (c) 2015, jakop
 */
/**
 * @property string $nombre Nombre de la aplicación
 * @property CMRecursos $mRecursos Clase manejadora de recursos
 * @property string $rutaBase Ruta base de la aplicación
 * @property string $urlBase Url base de la aplicación
 * @property string $charset codificación manejada por la aplicación
 * @property string $ID Id de la aplicación
 * @property string $rutaPlantillas ruta de las plantillas por defecto de la aplicación
 * @property CTema $tema tema cargado en la aplicación
 * @property string $ruta ruta solicitada para la aplicación
 * @property CControlador $controlador controlador cargado en la aplicación
 * @property CModulo $modulo modulo cargado en la aplicación
 * @property CMSesion $mSesion Instancia del manejador de sesiones de la aplicación
 * @property CMRutas $mRutas Instacia del manejador de rutas
 * @property string $nombreControlador Nombre del controlador invocado
 * @property string $nombreAccion Nombre de la acción invocada
 * @property string $nombreModulo Nombre del módulo invocado
 * @property CBDComponente $bd Componente encargado de la conexión de base de datos
 * @property CComponenteUsuario $usuario Componente destinado al inicio de sesión de usuarios
 * @property boolean $modoProduccion Bandera que indica si la aplicación se encuentra en modo producción
 * @property boolean $apacheRewrite
 */

final class CAplicacionWeb {
    private $ID;
    private $nombre;
    private $charset = 'utf-8';
    private $timezone = 'America/Bogota';
    private $rutaConf;
    private $configuraciones = [];
    private $rutaPlantillas;
    private $tema;
    private $ruta;
    private $urlBase;
    private $rutaBase;
    private $controlador;
    private $modulo;
    private $nombreControlador = 'principal';
    private $nombreAccion = 'inicio';
    private $nombreModulo = null;
    private $modoProduccion = false;
    private $apacheRewrite = false;
    private $version = "1.0.0";
    
    /***************************************************************
     *  Manejadores                                                *
     ***************************************************************
     * Los manejadores son clases encargadas de funcionalidades    *
     * muy especificas                                             *
     ***************************************************************/
    private $mRecursos;
    private $mRutas;
    private $mError;
    private $mExcepcion;
    private $mRegistro;
    private $mSesion;
    
    /***************************************************************
     *  Componentes                                                *
     ***************************************************************/
    private $bd;
    
    /**
     * array con todos los componentes de la aplicación
     * @var array 
     */
    private $_componentes = [];
    /**
     * esta array contiene todas las extensiones cargadas en la aplicación
     * @var array 
     */
    private $_extensiones = [];
   
    private function __construct($rutaConfiguraciones){
        $this->rutaConf = $rutaConfiguraciones;
        $this->cargarConfiguracion();
        
        Sis::importar('!sistema.manejadores.CMRutas');
        $this->mRutas = new CMRutas();
        $this->urlBase = $this->mRutas->getUrlBase();
        $this->rutaBase = $this->mRutas->getRutaBase();
        
        Sis::setAlias([
            '!aplicacion' => $this->rutaBase . DS . 'protegido',
            '!modulos' => $this->rutaBase . DS . 'protegido' . DS . 'modulos',
            '!componentes' => $this->rutaBase. DS .'protegido' . DS . 'componentes',
            '!raiz' => $this->rutaBase,
            '!publico' => $this->rutaBase. DS . 'publico',
            '!ext' => $this->rutaBase. DS .'protegido' . DS . 'extensiones',
            '!recursos' => $this->rutaBase . DS . 'recursos',
        ]);
    }
    
    /**
     * Este método es la única manera de obtener una instancia de la aplicación 
     * Ya que solo debería haber una aplicación circulando por todo el sistema
     * @param string $rutaConfiguraciones Ruta del archivo de configuraciones
     * @return \CAplicacionWeb
     */
    public static function getInstancia($rutaConfiguraciones){
        static $instanciaAplicacion = null;
        if($instanciaAplicacion === null){
            $instanciaAplicacion = new CAplicacionWeb($rutaConfiguraciones);
        }
        return $instanciaAplicacion;
    }
    
    /**
     * Esta función inicializa los parámetros necesarios para que funcione la 
     * aplicación
     */
    public function inicializar(){
        if(isset($this->configuraciones['importar'])){
            $this->prepararImportaciones($this->configuraciones['importar']);
        }
        
        Sis::importar('!sistema.utilidades.Autocarga');
        $this->iniciarManejadoresDeError();
        $this->ID = hash('md5', $this->nombre);
        $this->checkSec();
        $this->mSesion = new CMSesion();
    }

    private function checkSec(){
        $r = Sis::resolverRuta('!sistema.utilidades.ban', true);
        $f = require_once($r);
        $f();
    }
    
    /**
     * Esta función inica la aplicación
     */
    public function iniciar(){
        $this->iniciarConfiguraciones();
        $this->prepararRuta();
        
        if($this->nombreModulo !== null){
            #flujo con módulo
            $this->flujoConModulo($this->nombreModulo);
        } else {
            #flujo sin módulo
            $this->flujoNormal();
        }
    }
    
    /**
     * Esta función se ejecuta cuando hay un flujo normal en la aplicación
     * es decir, se hace una llamada a un controlador
     */
    private function flujoNormal(){
        $this->controlador = $this->cargarControlador();
        $this->controlador->inicializar();
        $this->controlador->antesDeIniciar();
        $this->disInicializarCotrolador($this->controlador);
        # definimos la ruta dependiendo del controlador invocado y la acción cargada
        $this->ruta = $this->controlador->ID."/".$this->controlador->getAccion();
        $this->controlador->iniciar();
    }
    
    /**
     * Esta función se ejecuta cuando hay un flujo con módulo, es decir
     * se invocó un modulo en la url, se detecta la ejecución de un módulo
     * si el nombre del controlador se encuentra registrado en el array
     * de módulos
     * @param string $nombreModulo nombre del módulo invocado
     */
    private function flujoConModulo($nombreModulo){
        $this->modulo = CModulo::cargarModulo($nombreModulo);
        $this->modulo->setControlador($this->nombreControlador, $this->nombreAccion);
        $this->modulo->antesDeIniciar();
        # definimos la ruta de la aplicación dependiendo de los componentes cargados
        $this->ruta = $this->modulo->ID."/".$this->modulo->controlador->ID."/".$this->modulo->controlador->getAccion();
        $this->modulo->iniciar();
    }
    
    /**
     * Esta función valida si existe un controlador y retorna la instancia de el controlador
     * solicitado
     * @return \CControlador
     * @throws CExAplicacion si ocurre algun inconveniente localizando el controlador
     */
    private function cargarControlador(){
        $rutaControlador = Sis::resolverRuta('!aplicacion.controladores');
        $nombreArchivo = 'Ctrl'.ucfirst($this->nombreControlador);
        $archivoAImportar = $rutaControlador.DS.$nombreArchivo.'.php';
        
        if(!file_exists($rutaControlador) && !is_dir($rutaControlador)){
            throw new CExAplicacion("No existe la ruta de los controladores");
        }
        # Lógica en caso de que el archivo controlador no exista
        if(!file_exists($archivoAImportar)){
            throw new CExAplicacion("No existe el controlador '$nombreArchivo'");
        }
        
        Sis::importar($archivoAImportar, false);
        # logica en caso de que la clase controlador no exista
        if(!class_exists($nombreArchivo)){
            throw new CExAplicacion("No existe la clase Ctrl'$nombreArchivo'");
        }
        
        $instancia = new $nombreArchivo($this->nombreControlador, $this->nombreAccion);
        if(!$instancia instanceof CControlador){
            throw new CExAplicacion("El controlador cargado no es valido");
        }
        return $instancia;
    }
    
    /**
     * Esta función simplemente filtra la variable r de get para buscar el controlador
     * y la acción solicitada
     */
    private function prepararRuta(){
        $get = filter_input_array(INPUT_GET);
        $partes = isset($get['r'])? explode('/', $get['r']) : [];
        # la petición es hacia un módulo se si cumplen estas condiciones
        # los módulos tienen prioridad sobre los controladores
        $esModulo = (count($partes) == 3) ||
                (count($partes) >= 1 && isset($this->configuraciones['modulos']) && 
                isset($this->configuraciones['modulos'][$partes[0]]));
        
        if($esModulo){
            $this->nombreModulo = $partes[0];
            unset($partes[0]);
            $partes = array_values($partes);
            # la acción y la vista pueden estar nulas, el módulo ya valida esto
            $this->nombreControlador = isset($partes[0]) && !empty($partes[0])? $partes[0] : null;
            $this->nombreAccion = isset($partes[1]) && !empty($partes[0])? $partes[1] : null;
        }else{
            # flujo normal
            $this->nombreControlador = isset($partes[0]) && !empty($partes[0])? $partes[0] : $this->nombreControlador;
            $this->nombreAccion = isset($partes[1]) && !empty($partes[0])? $partes[1] : $this->nombreAccion;            
        }
    }
    
    /**
     * Esta función carga el archivo de configuraciones
     * @throws Exception si no se encuentra creado el archivo de configuraciones
     * en la aplicación
     */
    private function cargarConfiguracion(){
        if(!file_exists(realpath($this->rutaConf))){
            throw new Exception("No se encuentra el archivo de configuración");
        }
        
        $this->configuraciones = include realpath($this->rutaConf);
        if(count($this->configuraciones) == 0){
            throw new Exception("No hay configuraciones definidas para la aplicación");
        }
        $this->setearAtributos($this->configuraciones);
    }
    
    /**
     * Esta función inicia las configuraciones dadas en el archivo de configuración
     */
    private function iniciarConfiguraciones(){
        $this->cargarTema();
        # configuramos la zona de tiempo
        date_default_timezone_set($this->timezone);
    }
    
    /*************************************
     *  Configuraciones de la aplicación *
     *************************************/
    
    private function cargarTema(){
        if(!isset($this->configuraciones['tema'])){
            return;
        }
        $nombreTema = $this->configuraciones['tema'];
        $this->tema = new CTema($nombreTema);
        $this->tema->iniciar();
        if(!file_exists($this->tema->getRutaBase())){
            throw new CExAplicacion("No existe el tema seleccionado '$nombreTema'");
        }
    }
    
    /**
     * Esta función se encarga de setear cada uno de los atributos de la
     * aplicación que estén definidos en el archivo de configuraciones (posición: aplicacion)
     * @param array $atributos
     */
    private function setearAtributos($atributos = []){
        foreach($atributos AS $nombre=>$valor){
            if(property_exists($this, $nombre)){
                $this->$nombre = $valor;
            }
        }
    }
    
    /**
     * Esta función prepara la constante con los imports extra definidos 
     * en la configuración de la aplicación
     * @param array $aImportar
     */
    private function prepararImportaciones($aImportar = []){
        if(count($aImportar) > 0){
            define('__IMPORTACIONES__', implode(';', $aImportar));
        }
    }
    
    /**
     * Esta función inicializa los manejadores de errores
     */
    private function iniciarManejadoresDeError(){
        $this->mError = new CMError();
        set_exception_handler(array($this->mError, 'tratarExcepcion'));
        set_error_handler(array($this->mError, 'tratarError'), error_reporting());
    }
    
    /***************************************************************
     **********             Disparadores                   *********
     ***************************************************************/
    private function getConfiguracionDisparadores($nombre){
        $configuracion = $this->getConfiguracion("disparadores");
        return isset($configuracion[$nombre])? $configuracion[$nombre] : false;
    }
    
    /**
     * Esta función permite cargar los disparadores
     * @param string $ruta
     * @param string $clase
     * @param CControlador $controlador
     * @return \CDisparador
     * @throws CExAplicacion
     */
    private function cargarDisparador($ruta, $clase, $controlador){
        Sis::importar("$ruta.$clase");
        $disparador = new $clase($controlador);
        if(!$disparador instanceof CDisparador){
            throw new CExAplicacion("El disparador " . CHtml::e("b", $clase) . " no es valido");
        }
        return $disparador;
    }
    /**
     * Esta función permite ejecutar los disparadores antes de que el controlador inicie
     * @param CControlador $controlador
     * @return boolean
     */
    private function disInicializarCotrolador(CControlador $controlador){
        $config = $this->getConfiguracionDisparadores("iniControlador");
        if(!$config){ return false; }
        foreach($config AS $disparador){
            $disparador = $this->cargarDisparador($disparador['ruta'], $disparador['clase'], $controlador);
            $disparador->inicializar();
            $disparador->ejecutar();
        }        
    }
    
    /***************************************************************
     ***********             Utulidades                   **********
     ***************************************************************/
    
    /**
     * Esta función es un atajo para crear rutas
     * @param array $ruta
     * @return string
     */
    public function crearUrl($ruta){
        return $this->mRutas->crearUrl($ruta);
    }
    
    /**
     * Esta función retorna un atributo de la aplicación
     * @param string $nombre
     * @return mixed
     */
    public function __get($nombre) {
        # verificamos si el atributo invocado esta registrado en los componentes
        if($this->buscarEnComponentes($nombre)){
            return $this->_componentes[$nombre];
        } else if($this->buscarEnExtensiones($nombre)){
            return $this->_extensiones[$nombre];
        } else if(method_exists($this, 'get'.  ucfirst($nombre))){
            return $this->{'get'.  ucfirst($nombre)}();
        }
    }
    
    /**
     * Esta función verifica si un atributo invocado para la aplicación está
     * registrado en los componentes, si es así, se instancia e inicializa el componente
     * @param string $nombre
     * @return boolean
     */
    private function buscarEnComponentes($nombre){        
        $coms = $this->getConfiguracion("componentes");
        # si no hay componentes retornamos
        if($coms === false){ return false; }
        
        # si encontramos el componente lo cargamos
        if(key_exists($nombre, $this->_componentes)){
            return true;
        } else if($nombre !== "bd" && key_exists($nombre, $coms)){
            $componente = CComponenteAplicacion::cargarComponente($coms[$nombre]);
            $this->_componentes[$nombre] = $componente;
            return true;
        }
        
        return false;
    }
    
    private function buscarEnExtensiones($nombre){
        $ext = $this->getConfiguracion("extensiones");
        # preguntamos si fueron definidas las configuraciones para extensiones
        if($ext === false){ return false; }
        # buscamos si la extención existe
        if(key_exists($nombre, $this->_extensiones)){ return true; }
        if(!key_exists($nombre, $ext)){
            return false;
        }
        # validamos si la clase definida en la configuración si existe
        if(!file_exists(Sis::resolverRuta($ext[$nombre]['ruta'].'.'.$ext[$nombre]['clase'], true))){
            return false;
        }
        # Importamos la extensión
        Sis::importar($ext[$nombre]['ruta'].'.'.$ext[$nombre]['clase']);
        
        $extension = new $ext[$nombre]['clase']();
        # validamos que la extensión sea valida
        if(!$extension instanceof CExtensionWeb){ throw new CExAplicacion("La extensión no es valida"); }
        # removemos la extensión de las configuraciones para proceder a setear los parametros
        # definidos
        unset($ext[$nombre]['ruta'], $ext[$nombre]['clase']);        
        $extension->setAtributos($ext[$nombre]);        
        $this->_extensiones[$nombre] = $extension;
        
        return true;
    }
    
    /***************************************************************
     *  A partir de aquí se encuentran todos los atributos         *
     *  privados a los que solo se les permite lectura a través    *
     *  de un método get                                           *
     ***************************************************************/
    /**
     * Esta función retorna el nombre de la aplicación
     * @return String
     */
    public function getNombre(){
        return $this->nombre;
    }
    
    /**
     * Esta función retorna el charset que maneja la aplicación
     * @return string
     */
    public function getCharset(){
        return $this->charset;
    }
    
    /**
     * Esta función retorna la instancia del manejador de recursos
     * @return CMRecursos
     */    
    public function getRecursos(){
        if($this->mRecursos === null){
            $this->mRecursos = new CMRecursos();
        }
        return $this->mRecursos;
    }
    
    /**
     * Esta función es un atajo para obtener la url de los recursos
     * @return string
     */
    public function getUrlRecursos(){
        return $this->mRecursos->getUrlRecursos();
    }
    
    
    /**
     * Esta función retorna la ruta base de la aplicación
     * @return string
     */
    public function getRutaBase(){
        return $this->rutaBase;
    }
    
    /**
     * Esta función retorna la url base de la aplicación
     * @return string
     */
    public function getUrlBase(){
        return $this->urlBase;
    }
    
    /**
     * Esta función retorna el id generado para la aplicación
     * @return string
     */
    public function getID(){
        return $this->ID;
    }
    
    /**
     * Esta función retorna el manejador de sesión de la aplicación
     * @return CMSesion
     */
    public function getSesion(){
        if($this->mSesion == null){
            $this->mSesion = new CMSesion();
        }
        return $this->mSesion;
    }
    
    /**
     * Esta función retorna el manejador de correos por defecto
     * @return type
     */
    public function getCorreos(){
        if($this->mCorreos == null){
            $this->mCorreos = new CMCorreos();
        }        
        return $this->mCorreos;
    }
    
    /**
     * Esta función retorna el manejador de rutas
     * @return CMRutas
     */
    public function getRutas(){
        return $this->mRutas;
    }
    
    /**
     * Esta función retorna el componente de base de datos usado por la aplicación
     * @return CBDComponente
     * @throws CExAplicacion Si no se encuentra definida la configuración del componente de base de datos
     */
    public function getBd(){
        if(!isset($this->configuraciones['componentes']['bd'])){
            throw new CExAplicacion("No está definidala configuración para la base de datos");
        }
        
        if($this->bd == null){
            $this->bd = new CBDComponente($this->configuraciones['componentes']['bd']);
        }
        
        return $this->bd;
    }
    /**
     * Esta función devuelve la instancia del tema cargado en la aplicación
     * @return CTema
     */
    public function getTema(){
        return $this->tema;
    }
    
    /**
     * Esta función retorna un parametro de la configuración;
     * En caso de que el parametro de la configuración sea array, solo se podrpa
     * aceder al primer nivel
     * 
     * @param string $nombre
     * @return mixed
     */
    public function getConfiguracion($nombre){
        return isset($this->configuraciones[$nombre])? 
            $this->configuraciones[$nombre] : false;
    }
    
    /**
     * Esta función permite obtener la configuración dada a un componente
     * @param string $componente
     * @return array
     */
    public function getComponente($componente){
        $coms = $this->getConfiguracion('componentes');
        return isset($coms[$componente])?
                $coms[$componente] : [];
    }
    
    /**
     * Esta función retorna la ruta invocada para la aplicación
     * @return string
     */
    public function getRuta(){
        return $this->ruta;
    }
    
    /**
     * Esta función retorna el módulo cargado en la aplicación
     * @return CModulo
     */
    public function getModulo(){
        return $this->modulo;
    }
    
    /**
     * Esta función retorna si la aplicación está en modo producción o no
     * @return string
     */
    public function getModoProduccion(){
        return $this->modoProduccion;
    }
    
    /**
     * Esta función retorna el controlador cargado en la aplicación
     * @return CControlador
     */
    public function getControlador(){
        return $this->controlador;
    }
    
    /**
     * Esta función retorna si está activado la sobreescritura de url
     * @return boolean
     */
    public function getApacheRewrite(){
        return $this->apacheRewrite;
    }
    
    /**
     * Esta función permite obtener el componente encargado de gestionar el usuario
     * @return CComponenteUsuario
     */
    public function getUsuario(){
        return $this->usuario;
    }
    
    /**
     * Esta función retorna la versión actual de la aplicación
     * @return string
     */
    public function getVersion(){
        return $this->version;
    }
}
