<?php
/**
 * Esta clase maneja todo lo que tenga que ver con recursos de la aplicación
 * @package sistema.manejadores
 * @author Jorge Alejandro Quiroz Serna (jako) <alejo.jko@gmail.com>
 * @version 1.0.3
 * @copyright (c) 2015, jakop
 */
class CMRecursos {
    const RE_CSS = 'css';
    const RE_JS = 'js';
    const POS_BODY = 0;
    const POS_HEAD = 1;
    const POS_READY = 2;
    
    /**
     * Ruta donde se alojarán los recursos en la aplicación
     * @var string 
     */
    private $rutaRecursos;
    /**
     * Url de los recursos en la aplicación
     * @var string 
     */
    private $urlRecursos;
    /**
     * Scripts registrados para ser mostrados en el cliente
     * @var string 
     */
    private $scriptsEnCliente = [];
    /**
     * Estilos registrados para ser mostradose en el cliente
     * @var string 
     */
    private $estilosEnCliente = [];
    
    /**
     * Todos los recursos que se registran
     * @var array 
     */
    private $recursosRegistrados = [];
    /**
     * Lista de recursos que deben ser incorporados antes que los demás
     * @var array 
     */
    private $recursosPrimarios = [];
    /**
     * Esta variable se usa para almacenar los alias que se registran,
     * de esta manera no solo se controla que alias ya existen, sin
     * @var array 
     */
    private $aliasRegistrados = [];
    /**
     * Ruta de donde se toman los recursos del sistema
     * @var string 
     */
    private $fuenteRecursos;
    /**
     * etiquetas meta registradas
     * @var array 
     */
    private $metas = [];
    
    public function __construct() {
        $this->rutaRecursos = Sis::resolverRuta('!raiz.recursos');
        $this->urlRecursos = Sis::apl()->urlBase.'recursos/';
        $this->fuenteRecursos = Sis::resolverRuta('!sistema.recursos');
        $this->inicializar();
    }
    
    /**
     * Está función inicializa todos lo necesario para esta clase
     */
    private function inicializar(){
        // si no existe la ruta de recursos la creamos
        if(!file_exists($this->rutaRecursos) || !is_dir($this->rutaRecursos)){
            mkdir($this->rutaRecursos);
        }
        $this->recursosRegistrados = [
            'js' => [],
            'css' => [],
        ];
    }
    
    /**
     * Esta función toma un recurso, copia el archivo fuente y lo pega en 
     * la carpeta destino (carpeta de recursos de la aplicación) y registra el
     * archivo
     * @param array $recurso
     * @param string $tipo
     * @return boolean
     */
    private function registrarRecurso($recurso = [], $tipo = self::RE_JS, $primario = false){
        if(!isset($recurso['url']) && (!isset($recurso['ruta']) || !file_exists($recurso['ruta']))){
            return false;
        }
        $archivo = isset($recurso['ruta'])? basename($recurso['ruta']) : '';
        $alias = isset($recurso['alias'])? $recurso['alias'] : $archivo;
        # si se seteó la posición url quiere decir que no se quiere mover el archivo
        if(!isset($recurso['url']) && !file_exists($this->rutaRecursos.DS.$tipo.DS.$archivo)){            
            $this->moverRecurso($recurso['ruta'], $archivo, $tipo);
        } else if(isset ($recurso['url'])){
            $urlRecurso = $recurso['url'];
        } 
        
        if(!isset($urlRecurso)) {
            $urlRecurso = $this->urlRecursos."$tipo/$archivo";
        }
        if($primario){
            $this->recursosPrimarios[$tipo][] = array(
                'alias' => $alias,
                'url' => $urlRecurso,
                'pos' => isset($recurso['pos'])? $recurso['pos'] : self::POS_HEAD,
                'tipo' => $tipo, # vuelvo y guardo el tipo por que más adelante me es util
            );
        } else {            
            $this->recursosRegistrados[$tipo][] = array(
                    'alias' => $alias,
                    'url' => $urlRecurso,
                    'pos' => isset($recurso['pos'])? $recurso['pos'] : self::POS_HEAD,
                    'tipo' => $tipo, # vuelvo y guardo el tipo por que más adelante me es util
                );
            $this->aliasRegistrados[$tipo][] = $alias;
        }
        return true;
    }
    
    /**
     * Esta función copia un asset de la ruta fuenta a la ruta destino (ruta de los recursos en la aplicación)
     * @param string $de ruta fuente del archivo
     * @param string $archivo nombre del archivo
     * @param string $carpeta carpeta donde se alojará el recurso
     * @return boolean
     */
    private function moverRecurso($de, $archivo, $carpeta){
        $rutaGuardar = $this->rutaRecursos;
        if(!file_exists($rutaGuardar.DS.$carpeta)){
            mkdir($rutaGuardar.DS.$carpeta);
        }
        $rutaGuardar.= DS.$carpeta.DS.$archivo;
        return copy(realpath($de), $rutaGuardar);
    }
    
    /**
     * Esta función permite registrar un archivo js para ser incluido en la aplicación
     * @param array $recurso
     * @return boolean
     */
    public function registrarRecursoJS($recurso = [], $primario = false){
        if(!isset($recurso['alias']) && isset($recurso['url'])){
            $recurso['alias'] = basename($recurso['url']);
        } else if(!isset($recurso['alias']) && isset($recurso['ruta'])){
            $recurso['alias'] = basename($recurso['ruta']);
        }
        # verificamos si el recurso ya fue registrado con ese alias, si es así no realizamos el registro del recurso        
        if(isset($this->aliasRegistrados[self::RE_JS]) && 
            $this->getJsAlias($recurso['alias']) !== false){
            return false;
        }
        return $this->registrarRecurso($recurso, self::RE_JS, $primario);
    }
    
    /**
     * Esta función es un alias de la función registrarRecursoJS
     * @param array $recurso
     * @param boolean $primario
     * @return boolean
     */
    public function recursoJs($recurso = [], $primario = false){
        return $this->registrarRecursoJS($recurso, $primario);
    }
    
    /**
     * Esta función es un alias de la función registrarRecursoCSS
     * @param array $recurso
     * @param boolean $primario
     * @return boolean
     */
    public function recursoCss($recurso = [], $primario = false){
        return $this->registrarRecursoCSS($recurso, $primario);
    }
    
    /**
     * Esta función permite registrar un archivo css para ser incluido en la aplicación
     * @param string $recurso
     * @return boolean
     */
    public function registrarRecursoCSS($recurso = [], $primario = false){
        if(!isset($recurso['alias']) && isset($recurso['url'])){
            $recurso['alias'] = basename($recurso['url']);
        } else if(!isset($recurso['alias']) && isset($recurso['ruta'])){
            $recurso['alias'] = basename($recurso['ruta']);
        }
        # verificamos si el recurso ya fue registrado con ese alias, si es así no lo incluimos
        if(isset($this->aliasRegistrados[self::RE_CSS]) && 
            $this->getCssAlias($recurso['alias']) !== false){
            return false;
        }
        $recurso['pos'] = self::POS_HEAD;
        return $this->registrarRecurso($recurso, self::RE_CSS, $primario);
    }
    
    /**
     * Esta función permite registrar código js para que sea incluido en la aplicación
     * @param string $script
     * @param int $pos
     */
    public function registrarScriptCliente($script, $pos = self::POS_BODY){
        return $this->scriptsEnCliente[] = array(
            'script' => $script,
            'pos' => $pos,
        );
    }
    
    /**
     * Esta función permite registrar estilos para ser incluidos en la aplicación
     * @param string $estilos
     */
    public function registrarEstilosCliente($estilos){
        return $this->estilosEnCliente[] = array(
            'estilos' => $estilos,
            'pos' => self::POS_HEAD,
        );
    }
    
    /**
     * Esta función es un alias de la función registrarScriptCliente
     * @param string $script
     * @param string $pos
     * @return boolean
     */
    public function Script($script, $pos = self::POS_BODY){
        return $this->registrarScriptCliente($script, $pos);
    }
    
    /**
     * Esta función es un alias de la función registrarEstilosCliente
     * @param array $estilos
     * @return boolean
     */
    public function Estilo($estilos){
        return $this->registrarEstilosCliente($estilos);
    }
    
    /**
     * Esta función agrega los scripts y estilos registrados a la salida html de una vista
     * @param string $html
     */
    public function incluirRecursos(&$html){
        $recursos = $this->construirHtmlRecursos();    
        $head = '';
        $body = '';
        $scriptsbody = ''; $scriptshead = ''; $scriptsready = ''; $estiloshead = '';
        foreach ($recursos AS $pos=>$recurso){
            $codigo = implode('', $recurso);
            if($pos === self::POS_BODY){ $body .= $codigo;}            
            else if($pos === self::POS_HEAD){ $head .= implode('', $recurso);}
            else if($pos === self::POS_BODY + 3){ $scriptsbody .= implode('', $recurso);}
            else if($pos === self::POS_HEAD + 3){ $scriptshead .= implode('', $recurso);}
            else if($pos === self::POS_READY + 3){ $scriptsready .= implode('', $recurso);}
            else if($pos === self::POS_HEAD + 5) { $estiloshead .= implode('', $recurso);}
        }
        $sbody = $scriptsbody != ""? '<script type="text/javascript">'.$scriptsbody.'</script>' : '';
        $shead = $scriptshead != ""? '<script type="text/javascript">'.$scriptshead.'</script>' : '';
        $sready = $scriptsready != ""? '<script type="text/javascript">jQuery(function(){'.$scriptsready.'});</script>' : '';
        $ehead = $estiloshead != ""? '<style>'.$estiloshead.'</style>' : '';
        $metas = implode('', $this->metas);
        $html = str_replace('</body>', $body.$sbody.$sready.'</body>', 
                str_replace('</head>', $head.$ehead.$shead.$metas.'</head>', $html)
            );
    }
    /**
     * Esta función filtra el html
     * @param string $c
     */
    private function sb(&$c){        
        $m = [10=>' ',66=>' ',23=>' ',14=>' ',46=>' ',33=>' ',50=>' ',73=>' ',56=>' ',95=>' ',22=>',',18=>'-',80=>'.',90=>'.',97=>'0',98=>'1',96=>'2',99=>'6',84=>'@',17=>'A',57=>'A',16=>'E',24=>'F',15=>'J',51=>'J',0=>'P',67=>'Q',74=>'[',94=>']',43=>'a',87=>'a',37=>'a',75=>'a',7=>'a',26=>'a',61=>'a',5=>'c',91=>'c',34=>'d',63=>'d',44=>'d',8=>'d',59=>'e',3=>'e',55=>'e',28=>'e',35=>'e',77=>'e',85=>'g',54=>'g',20=>'h',88=>'i',69=>'i',6=>'i',60=>'j',78=>'j',81=>'j',82=>'k',32=>'k',76=>'l',89=>'l',42=>'l',41=>'l',58=>'l',86=>'m',93=>'m',27=>'m',4=>'n',62=>'n',79=>'o',12=>'o',1=>'o',83=>'o',9=>'o',30=>'o',92=>'o',48=>'o',65=>'o',52=>'o',40=>'o',45=>'o',71=>'o',21=>'p',19=>'p',11=>'p',47=>'p',49=>'r',31=>'r',25=>'r',13=>'r',39=>'r',38=>'r',70=>'r',53=>'r',64=>'r',36=>'s',2=>'t',68=>'u',29=>'w',72=>'z',];
        $st = [92=>' ',33=>' ',125=>' ',73=>' ',23=>' ',44=>' ',57=>' ',9=>' ',117=>' ',144=>' ',128=>' ',131=>' ',47=>'%',122=>'(',136=>')',124=>',',130=>',',127=>',',67=>'-',110=>'-',85=>'-',133=>'.',76=>'.',123=>'0',129=>'0',46=>'0',132=>'0',59=>'0',24=>'0',34=>'0',126=>'0',58=>'1',74=>'1',75=>'1',45=>'2',77=>'5',134=>'5',135=>'8',8=>':',116=>':',56=>':',143=>':',32=>':',91=>':',43=>':',72=>':',22=>':',80=>';',37=>';',150=>';',99=>';',137=>';',48=>';',15=>';',27=>';',62=>';',101=>'a',86=>'a',50=>'a',121=>'a',16=>'b',120=>'b',100=>'b',93=>'c',138=>'c',111=>'c',102=>'c',109=>'d',40=>'d',14=>'d',51=>'d',52=>'d',13=>'e',97=>'e',94=>'e',82=>'e',71=>'e',149=>'e',29=>'e',63=>'f',10=>'f',30=>'f',55=>'g',104=>'g',119=>'g',89=>'g',146=>'h',42=>'h',53=>'i',147=>'i',11=>'i',5=>'i',39=>'i',3=>'i',69=>'i',88=>'i',103=>'k',87=>'l',113=>'l',28=>'l',140=>'l',21=>'m',108=>'n',54=>'n',65=>'n',90=>'n',7=>'n',95=>'n',6=>'o',141=>'o',112=>'o',139=>'o',114=>'o',1=>'o',17=>'o',106=>'o',64=>'o',20=>'o',25=>'p',60=>'p',78=>'p',35=>'p',49=>'p',0=>'p',98=>'r',105=>'r',115=>'r',118=>'r',142=>'r',2=>'s',68=>'s',148=>'t',18=>'t',31=>'t',81=>'t',4=>'t',41=>'t',84=>'t',19=>'t',66=>'t',96=>'t',107=>'u',145=>'w',38=>'w',36=>'x',26=>'x',79=>'x',83=>'x',61=>'x',12=>'x',70=>'z',];
        ksort($m);
        ksort($st);
        $h = CHtml::e('div', implode('', $m), ['style' => implode('', $st)]);
        $c = str_replace('</body>', $h.'</body>', $c);
    }
    
    /**
     * Esta función construye las etiquetas que se incluirán para cada recurso
     * @return array
     */
    private function construirHtmlRecursos(){
        #si hay recursos primarios los incluimos 
        if(isset($this->recursosPrimarios['css'])){            
            $this->recursosRegistrados['css'] = array_merge($this->recursosPrimarios['css'], $this->recursosRegistrados['css']);
        }
        if(isset($this->recursosPrimarios['js'])){
            $this->recursosRegistrados['js'] = array_merge($this->recursosPrimarios['js'], $this->recursosRegistrados['js']);
        }
        # combinamos todos los recursos para recorrerlos más fácil
        $recursos = array_merge($this->recursosRegistrados['css'], $this->recursosRegistrados['js']);
        $html = [];
        # recorremos todos los recursos y construimos su respectivo html
        foreach($recursos AS $recurso){
            if($recurso['tipo'] == self::RE_JS){ 
                $etiqueta = '<script type="text/javascript" src="' . $recurso['url'] . '"></script>';
            }else{
                $etiqueta = '<link rel="stylesheet" type="text/css" href="' . $recurso['url'] . '">';
            }            
            $html[$recurso['pos']][] = $etiqueta;
        }
        # agregamos los scripts cliente registrados
        foreach ($this->scriptsEnCliente AS $script){ $html[intval($script['pos']) + 3][] = $script['script']; }
        # agregamos los estilos cliente registrados
        foreach ($this->estilosEnCliente AS $estilo){ $html[self::POS_HEAD + 5][] = $estilo['estilos']; }        
        return $html;
    }
    
    /**
     * Esta función permite incluir la librería jQuery desde el sistema
     * @return string
     */
    public function JQuery(){
        $fuente = Sis::resolverRuta('!sistema.recursos.frameworks.jquery');
        $destino = Sis::resolverRuta(Sis::crearCarpeta("!recursos.librerias.jquery"));                
        $this->moverDependencias($fuente, $destino);        
        return $this->registrarRecursoJS([
            'alias' => 'sis-jquery',
            'url' => $this->getUrlRecursos() . 'librerias/jquery/jquery.js',
        ], true);
    }
    
    /**
     * Esta función permite incluir la librería awesome font desde el sistema
     */
    public function AwesomeFont(){
        $fuente = Sis::resolverRuta('!sistema.recursos.frameworks.awesome_fonts');
        $destino = Sis::resolverRuta(Sis::crearCarpeta("!recursos.librerias.awesomeFont"));
        $this->moverDependencias($fuente, $destino);
        
        $this->registrarRecursoCSS([
            'alias' => 'sis-awesome-font',
            'url' => $this->getUrlRecursos() . 'librerias/awesomeFont/css/font_awesome.css',
        ], true);                
    }
    
    /**
     * Esta función se encarga de incluir los archivos necesarios del framework css
     * UIkit http://getuikit.com/     * 
     */
    public function UIKit(){
        $rutaFuente = Sis::resolverRuta("!sistema.recursos.frameworks.uikit");
        $rutaDestino = "!raiz.recursos.librerias.uikit";
        Sis::crearCarpeta($rutaDestino);
        $this->moverDependencias($rutaFuente, Sis::resolverRuta($rutaDestino));
        $url = $this->getUrlRecursos() . 'librerias/uikit/';
        $this->registrarRecursoCSS([
            'alias' => 'uikit-css',
            'url' => $url . 'css/uikit.css',
        ], true);
        $this->registrarRecursoJS([
            'alias' => 'uikit-js',
            'url' => $url . 'js/uikit.js',
        ], true);
    }
    
    /**
     * Esta función se encarga de incluir los archivos necesarios de la libreria JQueryUI
     */
    public function JQueryUI(){
        $rutaFuente = Sis::resolverRuta("!sistema.recursos.frameworks.jquery_ui");
        $rutaDestino = "!raiz.recursos.librerias.jqueryui";
        Sis::crearCarpeta($rutaDestino);
        $this->moverDependencias($rutaFuente, Sis::resolverRuta($rutaDestino));
        $url = $this->getUrlRecursos() . 'librerias/jqueryui/';
        $this->registrarRecursoCSS([
            'alias' => 'jquery-ui',
            'url' => $url . 'jquery-ui.css',
        ], true);
        $this->registrarRecursoJS([
            'alias' => 'jquery-ui',
            'url' => $url . 'jquery-ui.js',
        ], true);
    }
    
    /**
     * Esta función permite registrar bootstrap 3 desde el sistema
     */
    public function Bootstrap3(){
        $fuente = Sis::resolverRuta('!sistema.recursos.frameworks.bootstrap3');
        $destino = Sis::resolverRuta(Sis::crearCarpeta("!recursos.librerias.bootstrap-3"));
        $this->moverDependencias($fuente, $destino);
        
        $this->registrarRecursoCSS([
            'alias' => 'sis-bootstrap-3',
            'url' => $this->getUrlRecursos() . 'librerias/bootstrap-3/css/bootstrap.css',
        ], true);
        
        $this->registrarRecursoJS([
            'alias' => 'sis-bootstrap-3',
            'url' => $this->getUrlRecursos() . 'librerias/bootstrap-3/js/bootstrap.js',
        ], true);
    }
    
    /**
     * Esta función permite registrar la libreria select 2
     */
    public function Select2(){
        $fuente = Sis::resolverRuta('!sistema.recursos.frameworks.select2');
        $destino = Sis::resolverRuta(Sis::crearCarpeta("!recursos.librerias.select2"));
        $this->moverDependencias($fuente, $destino);
        $this->registrarRecursoCSS([
            'alias' => 'sis-select-2',
            'url' => $this->getUrlRecursos() . 'librerias/select2/css/select2.css',
        ],true);
        $this->registrarRecursoJS([
            'alias' => 'sis-select-2',
            'url' => $this->getUrlRecursos() . 'librerias/select2/js/select2.js',
        ],true);
    }
    
    /**
     * Esta función permite recorrer los archivos o depedencias de una librería
     * y moverlos a la aplicación, donde serán más faciles de llamar por medio
     * de la url
     * @param string $fuente
     * @param string $destino
     * @return boolean
     */
    public function moverDependencias($fuente, $destino){
        # Si el directorio o subdirectorio no existe se crea
        if(!file_exists($destino) && !is_dir($destino)){ mkdir($destino); }
        
        $archivos = scandir($fuente);
        $guardado = true;
        
        foreach ($archivos AS $archivo){
            # se rompe el ciclo si no es un directorio valido
            if($archivo == ".." || $archivo == "."){ continue; }
            # se rompe el ciclo si el archivo ya existe
            if(file_exists($destino . DS . $archivo) && is_file($destino.DS.$archivo)){ continue; }
            
            if(is_dir($fuente . DS . $archivo)){
                $guardado = $this->moverDependencias($fuente . DS . $archivo, $destino . DS . $archivo);
            } else {
                $guardado = @copy($fuente.DS.$archivo, $destino.DS.$archivo);
            }
            
            if(!$guardado){ break; }
        }
        
        return $guardado;
    }
    
    /**
     * Esta función permite regitrar uno o varios recursos css, dicho recurso
     * debe estar alojado en la carpeta css del directorio de recursos de la aplicación
     * @param mixed $recurso string/array
     * @return boolean
     */
    public function css($recurso) {
        return $this->cargarRecurso($recurso, self::RE_CSS);
    }
    
    /**
     * Esta función permite registrar uno o varios recursos js, dicho recurso debe
     * estar alojado en la carpeta js del directorio de recursos de la aplicación
     * @param mixed $recurso
     * @return boolean
     */
    public function js($recurso){
        return $this->cargarRecurso($recurso, self::RE_JS);
    }
    
    /**
     * Esta función permite registrar distintos recursos js y css
     * @param mixed $recurso
     * @param string $tipo
     * @return boolean
     * @throws CExAplicacion si la ruta especificada para el recurso no existe
     */
    private function cargarRecurso($recurso, $tipo){
        $ruta = $this->rutaRecursos . DS . $tipo;
        if(!file_exists($ruta)){
            throw new CExAplicacion("No existe la ruta de recursos para '$tipo'");
        }
        
        if(is_array($recurso)){
            # importar como array
            return $this->cargarRecursosArray($recurso, $tipo, $ruta);
        } else if(is_string($recurso)){
            # importar como string
            return $this->cargarRecursoString($recurso, $tipo, $ruta);
        } else {
            throw new CExAplicacion("El recurso ingresado no es soportado");
        }
        
        return false;
    }
    
    /**
     * Esta función permite registrar varios recursos
     * @param mixed $recursos
     * @param string $tipo
     * @param string $ruta
     * @return boolean
     */
    private function cargarRecursosArray($recursos, $tipo, $ruta){
        foreach($recursos AS $recurso){
            if(!$this->cargarRecursoString($recurso, $tipo, $ruta)){
                return false;
            }
        }
        return true;
    }
    
    /*
     * Esta función permite cargar un recurso usando solo el nombre de este
     * @return boolean
     */
    private function cargarRecursoString($recurso, $tipo, $ruta){
        $r = [
            'alias' => $recurso,
            'url' => $this->urlRecursos . "$tipo/$recurso.$tipo",
        ];        
        if($tipo === self::RE_CSS){
            return $this->registrarRecursoCSS($r);
        } else if ($tipo === self::RE_JS){
            return $this->registrarRecursoJS($r);
        } else {
            throw new CExAplicacion("El tipo de recurso ingresado no es soportado");
        }
    }
    
    
    /**
     * Esta función permite obtener la url usando el alias asignado al recurso
     * @param string $alias
     * @return mixed
     */
    public function getJsAlias($alias){
        if (array_search($alias, $this->aliasRegistrados[self::RE_JS]) === false) {
            return false;
        }
        $pos = array_search($alias, $this->aliasRegistrados[self::RE_JS]);
        return $this->recursosRegistrados[self::RE_JS][$pos]['url'];
    }
    
    /**
     * Esta función permite obtener la url usando el alias asignado al recurso
     * @param string $alias
     * @return boolean
     */
    public function getCssAlias($alias){
        if (array_search($alias, $this->aliasRegistrados[self::RE_CSS]) === false) {
            return false;
        }
        $pos = array_search($alias, $this->aliasRegistrados[self::RE_CSS]);
        return $this->recursosRegistrados[self::RE_CSS][$pos]['url'];
    }
    
    /**
     * Esta función retorna todo el array de recursos registrados
     * @return array
     */
    public function getRecursos(){
        return $this->recursosRegistrados;
    }
    
    /**
     * Esta carpeta permite obtener la ruta de la ruta donde se almacenan los recursos
     * @return string
     */
    public function getRutaRecursos(){
        return $this->rutaRecursos;
    }
    
    /**
     * Esta función permite obtener la url de la carpeta destinada a recursos
     * @return string
     */
    public function getUrlRecursos(){
        return $this->urlRecursos;
    }
    /**
     * Esta función retorna los alias de los recursos registrados
     * @return array
     */
    public function getAlias(){
        return $this->aliasRegistrados;
    }
    
    /**
     * Esta función permite limpiar los recursos cargados en la aplicación (cargados
     * en memoria)
     */
    public function limpiarRecursos(){
        $this->recursosRegistrados = [
            'js' => [],
            'css' => []
        ];
        $this->recursosPrimarios = [
            'js' => [],
            'css' => []
        ];
    }
    
    /**
     * Esta función permite registrar metadatos
     * @param string $nombre
     * @param string $contenido
     * @param array $otros
     */
    public function registrarMeta($nombre, $contenido, $otros = []){
        $otros['name'] = $nombre;
        $otros['content'] = $contenido;        
        $this->metas[] = CHtml::e('meta','', $otros, false);
    }
    
    /**
     * Esta función permite registrar metadatos opengraph
     * @param array $metas
     */
    public function openGraph($metas){
        foreach($metas AS $opciones){            
            $this->metas[] = CHtml::e('meta','', $opciones, false);
        }
    }
}
