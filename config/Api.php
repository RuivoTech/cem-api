<?php

class Api {
    public $service;
    public $metodo;
    public $parametros;

    public function __construct($url, $metodoArray) {
        $urlSeparada = $this->parseURL($url);
        
        $this->setService($urlSeparada);
        $this->setMetodo($urlSeparada);
        $this->setParametros($urlSeparada, $metodoArray);
    }
    
    private function parseURL($url){
        $url =  explode("/", $url);
        
        if($url[1] == "cem-api"){
            array_shift($url);
            array_shift($url);
        }elseif(Empty($url[0])){
            array_shift($url);
        }
        
        return $url;
    }
    
    private function setService($url) {
        if(!empty($url[0]) && isset($url[0])){
            if(class_exists(ucfirst($url[0] . "Service"))){
                $this->service = ucfirst($url[0] . "Service");
            }else{
                throw new Exception("Service não existe!");
            }
        }else{
            throw new Exception("Service não encontrado!");
        }
    }
    
    private function setMetodo($url) {
        if(!empty($url[1]) && isset($url[1])){
            if(method_exists($this->service, $url[1])){
                $this->metodo = $url[1];
            }else{
                throw new Exception("Método não existe!", 500);
            }
        }else{
            throw new Exception("Método não encontrado!", 500);
        }
    }
    
    private function setParametros($url, $requestMethod) {
        if ($requestMethod == "POST" || $requestMethod == "PUT") {
            $valor = json_decode(file_get_contents('php://input'));
            if(isset($valor->explicitType)){
                $dados = $this->converterParaObjeto($valor);
            }else{
                $dados = (array) $valor;
            }
            
            $this->parametros = $dados;
        }else{
            if(count($url) > 2){
                $valor = array_slice($url, 2);
                if(sizeof($valor) > 1) {
                    $this->parametros = $valor;
                } else {
                    $this->parametros = $valor[0];
                }
            }
        }
    }
    
    public function getService() {
        return $this->service;
    }
    
    public function getMetodo() {
        return $this->metodo;
    }
    
    public function getParametros() {
        return $this->parametros;
    }
    
    private function converterParaObjeto($dados) {        
        $items = array();
        error_log(print_r($dados, true));
        foreach ($dados as $chave => $valor) {
            if(is_array($valor)) {
                for ($i = 0; $i < count($valor); $i++) {
                    $item = $valor[$i];
                    $items[] = $this->convertObjectClass($item, ucfirst($item->explicitType));
                }
                $dados->$chave = $items;
            }elseif(is_object($dados->$chave)){
                $dados->$chave = $this->convertObjectClass($dados->$chave, ucfirst($dados->$chave->explicitType));
            }
        }
        
        $objeto = $this->convertObjectClass($dados, ucfirst($dados->explicitType));
        
        return $objeto;
    }
    
    private function convertObjectClass($object, $final_class) {
        return unserialize(sprintf(
            'O:%d:"%s"%s',
            strlen($final_class),
            $final_class,
            strstr(strstr(serialize($object), '"'), ':')
            ));
    } 
    
}