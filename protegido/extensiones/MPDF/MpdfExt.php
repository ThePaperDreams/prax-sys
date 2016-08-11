<?php
class MpdfExt extends CExtensionWeb{
    
    public function __construct() {
        Sis::importar("!ext.MPDF.recursos.mpdf");
    }
    
    public function crear(){        
        return new Mpdf();
    }
    
}
