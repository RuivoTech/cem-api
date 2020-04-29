<?php

class EventoService {
    
    public static function salvar(Evento $evento) {
        $eventoDao = new EventoDao();
        
        if($evento->ehNovo()) {
            return $eventoDao->inserir($evento);
        }else{
            return $eventoDao->alterar($evento);
        }
    }
    
    public static function listar($valor) {
        $eventoDao = new EventoDao();
        
        return $eventoDao->listar($valor);
    }
    
    public static function remover($id) {
        $eventoDao = new EventoDao();
        
        return $eventoDao->remover($id);
    }
}

