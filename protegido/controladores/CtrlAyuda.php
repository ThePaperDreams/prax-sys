<?php
class CtrlAyuda extends CControlador{
    
    public function accionGetAyuda(){
        $ayuda = $this->_p['ayuda'];
        $this->json([
            'head' => 'Ayuda',
            'body' => $this->vistaP($ayuda),
        ]);
    }
    
}