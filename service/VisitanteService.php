<?php

class VisitanteService {

    public static function salvar(Visitante $visitante){
        $visitanteDao = new VisitanteDao();

        if($visitante->ehNovo()){
            return $visitanteDao->inserir($visitante);
        }else{
            return $visitanteDao->alterar($visitante);
        }
    }

    public static function listar(){
        $visitanteDao = new VisitanteDao();

        return $visitanteDao->listar();
    }

    public static function localizar($id){
        $visitanteDao = new VisitanteDao();

        return $visitanteDao->localizar($id);
    }
    
    public static function remover($id) {
        $visitanteDao = new VisitanteDao();
        
        return $visitanteDao->remover($id);
    }
}