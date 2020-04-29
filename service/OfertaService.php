<?php

class OfertaService {
    
    public static function salvar(Oferta $oferta) {
        $ofertaDao = new OfertaDao();
        
        if($oferta->ehNovo()){
            return $ofertaDao->inserir($oferta);
        }else{
            return $ofertaDao->alterar($oferta);
        }
    }
    
    public static function listar() {
        $ofertaDao = new OfertaDao();
        
        return $ofertaDao->listar();
    }
    
    public static function localizaar($id) {
        $ofertaDao = new OfertaDao();
        
        return $ofertaDao->localizar($id);
    }
}

