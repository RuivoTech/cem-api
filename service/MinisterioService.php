<?php

class MinisterioService {
    public static function salvar(Ministerio $ministerio) {
        $ministerioDao = new MinisterioDao();
        
        if($ministerio->ehNovo()){
            return $ministerioDao->inserir($ministerio);
        }else{
            return $ministerioDao->alterar($ministerio);
        }
    }
    
    public static function listar() {
        $ministerioDao = new MinisterioDao();
        
        return $ministerioDao->listar();
    }
    
    public static function remover($id) {
        $MinisterioDao = new MinisterioDao();
        
        return $MinisterioDao->remover($id);
    }
}

