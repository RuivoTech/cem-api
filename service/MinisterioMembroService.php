<?php

class MinisterioMembroService {
    public static function salvar(MinisterioMembro $ministerioMembro) {
        $ministerioMembroDao = new MinisterioMembroDao();

        if($ministerioMembro->ehNovo()){
            return $ministerioMembroDao->inserir($ministerioMembro);
        }else{
            return $ministerioMembroDao->alterar($ministerioMembro);
        }
    }

    public static function listar() {
        $ministerioMembroDao = new MinisterioMembroDao();

        return $ministerioMembroDao->listar();
    }

    public static function localizar($id) {
        $ministerioMembroDao = new MinisterioMembroDao();

        return $ministerioMembroDao->localizar($id);
    }

    public static function localizarPorMembro($id) {
        $ministerioMembroDao = new MinisterioMembroDao();

        return $ministerioMembroDao->localizarPorMembro($id);
    }

    public static function removerPorMembro($id) {
        $ministerioMembroDao = new MinisterioMembroDao();

        return $ministerioMembroDao->removerPorMembro($id);
    }
}