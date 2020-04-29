<?php

class ModuloService {
    
    public static function salvar(Modulo $modulo) {
        $moduloDao = new ModuloDao();
        
        if($modulo->ehNovo()) {
            return $moduloDao->inserir($modulo);
        }else{
            return $moduloDao->alterar($modulo);
        }
    }
    
    public static function listar() {
        $moduloDao = new ModuloDao();
        
        return $moduloDao->listar();
    }
}

