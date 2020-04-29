<?php

class MenuService {
    
    public static function salvar(Menu $menu) {
        $menuDao = new MenuDao();
        
        if($menu->ehNovo()){
            return $menuDao->inserir($menu);
        }else{
            return $menuDao->alterar($menu);
        }
    }
    
    public static function listar() {
        $menuDao = new MenuDao();
        
        return $menuDao->listar();
    }
    
    public static function localizar($id) {
        $menuDao = new MenuDao();
        
        return $menuDao->localizar($id);
    }
    
    public static function remover($id) {
        $menuDao = new MenuDao();
        
        return $menuDao->remover($id);
    }
    
}

