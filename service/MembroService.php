<?php

class MembroService {
    
    public static function salvar(Membro $membro){
        $membroDao = new MembroDao();
        
        if($membro->ehNovo()){
            return $membroDao->inserir($membro);
        }else{
            
            return $membroDao->alterar($membro);
        }
    }
    
    public static function listar(){
        $membroDao = new MembroDao();
        
        return $membroDao->listar();
    }
    
    public static function listarAniversariante(){
        $membroDao = new MembroDao();
        
        return $membroDao->listarAniversariante();
    }
    
    public static function localizar($id){
        $membroDao = new MembroDao();
        
        return $membroDao->localizar($id);
    }
    
    public static function remover($id) {
        $membroDao = new MembroDao();
        
        return $membroDao->remover($id);
    }
}

