<?php 

class DadosIgrejaService {
    
    public static function salvar(DadosIgreja $dadosIgreja) {
        $dadosIgrejaDao = new DadosIgrejaDao();
        if($dadosIgreja->ehNovo()) {
            return $dadosIgrejaDao->inserir($dadosIgreja);
        }else{
            return $dadosIgrejaDao->alterar($dadosIgreja);
        }
    }
    
    public static function listar() {
        $dadosIgrejaDao = new DadosIgrejaDao();
        
        return $dadosIgrejaDao->listar();
    }
}