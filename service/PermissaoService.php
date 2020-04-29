<?php

class PermissaoService {
    public static function salvar(Permissao $permissao) {
        $permissaoDao = new PermissaoDao();
        
        if($permissao->ehNovo()) {
            return $permissaoDao->inserir($permissao);
        }else{
            return $permissaoDao->alterar($permissao);
        }
    }
    
    public static function listar() {
        $permissaoDao = new PermissaoDao();
        
        return $permissaoDao->listar();
    }
    
    public static function localizar($id) {
        $permissaoDao = new PermissaoDao();
        
        return $permissaoDao->localizar($id);
    }
    
    public static function remover($id) {
        $permissaoDao = new PermissaoDao();
        
        return $permissaoDao->remover($id);
    }
    
    public static function removerPorUsuario($id) {
        $permissaoDao = new PermissaoDao();
        
        return $permissaoDao->removerPorUsuario($id);
    }
}

