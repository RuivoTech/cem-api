<?php

class UsuarioService {
    
    public static function salvar(Usuario $usuario){
        $usuarioDao = new UsuarioDao();
        
        if($usuario->ehNovo()){
            return $usuarioDao->inserir($usuario);
        }else{
            return $usuarioDao->alterar($usuario);
        }
    }
    
    public static function listar(){
        $usuarioDao = new UsuarioDao();
        
        return $usuarioDao->listar();
    }
    
    public static function localizar($id){
        $usuarioDao = new UsuarioDao();
        
        return $usuarioDao->localizar($id);
    }

    public static function login(array $login){
        $usuarioDao = new UsuarioDao();

        return $usuarioDao->login($login);
    }
    
    public static function remover($id) {
        $usuarioDao = new UsuarioDao();
        
        return $usuarioDao->remover($id);
    }
}

