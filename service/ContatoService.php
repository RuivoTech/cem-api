<?php 

class ContatoService {
    
    public static function salvar(Contato $contato) {
        $contatoDao = new ContatoDao();
        if($contato->ehNovo()) {
            return $contatoDao->inserir($contato);
        }else{
            return $contatoDao->alterar($contato);
        }
    }
    
    public static function listar() {
        $contatoDao = new ContatoDao();
        
        return $contatoDao->listar();
    }
}