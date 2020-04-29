<?php 

class EnderecoService {
    
    public static function salvar(Endereco $endereco) {
        $enderecoDao = new EnderecoDao();
        if($endereco->ehNovo()) {
            return $enderecoDao->inserir($endereco);
        }else{
            return $enderecoDao->alterar($endereco);
        }
    }
    
    public static function listar() {
        $enderecoDao = new EnderecoDao();
        
        return $enderecoDao->listar();
    }
}