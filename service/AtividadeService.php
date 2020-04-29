<?php

class AtividadeService {
    
    public static function salvar(Atividade $atividade) {
        $atividadeDao = new AtividadeDao();
        
        if($atividade->ehNovo()) {
            return $atividadeDao->inserir($atividade);
        }else{
            return $atividadeDao->alterar($atividade);
        }
    }
    
    public static function listar() {
        $atividadeDao = new AtividadeDao();
        
        return $atividadeDao->listar();
    }
    
    public static function localizar($id) {
        $atividadeDao = new AtividadeDao();
        
        return $atividadeDao->localizar($id);
    }
    
    public static function remover($id) {
        $atividadeDao = new AtividadeDao();
        
        return $atividadeDao->remiver($id);
    }
}

