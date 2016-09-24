<?php

class JMail extends CComponenteAplicacion{
    public $_contentType = 'text/html';
    public $_mime = '1.0';
    public $_charset = 'UTF-8';
    public $_emailAdmin = 'demo@localhost.com';
    
    public function enviar($para, $asunto, $mensaje, $config = []){
        $de = isset($config['de'])? $config['de'] : $this->_emailAdmin;
        $responderA = isset($config['responder'])? $config['responder'] : $this->_emailAdmin;
        $headers = [
            "From: $de",
            "Content-type:$this->_contentType; charset=$this->_charset",
            "Reply-To:$responderA",
            "MIME-Version: $this->_mime",
        ];
        return mail($para, $asunto, $mensaje, implode("\r\n", $headers));
    }
    
}
