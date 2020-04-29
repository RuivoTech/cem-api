<?php

class DizimoService {
    
    public static function salvar(Dizimo $dizimo) {
        $dizimoDao = new DizimoDao();
        
        if($dizimo->ehNovo()){
            return $dizimoDao->inserir($dizimo);
        }else{
            return $dizimoDao->alterar($dizimo);
        }
    }
    
    public static function listar() {
        $dizimoDao = new DizimoDao();
        
        return $dizimoDao->listar();
    }
    
    public static function localizar($id) {
        $dizimoDao = new DizimoDao();
        
        return $dizimoDao->localizar($id);
    }
}

