<?php

class InscricaoService {
    
    public static function salvar(Inscricao $inscricao) {
        $inscricaoDao = new InscricaoDao();
        
        if($inscricao->ehNovo()){
            return $inscricaoDao->inserir($inscricao);
        }else{
            return $inscricaoDao->alterar($inscricao);
        }
    }
    
    public static function listar() {
        $inscricaoDao = new InscricaoDao();
        
        return $inscricaoDao->listar();
    }
}

