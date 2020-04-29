<?php

class Encrypt {
    
    public static function criptografar($dados) {
        if(empty($dados)){
            throw new Exception("Variável dados está vazia!");
        }
        
        $dadosCriptografados = base64_encode($dados);
        
        return $dadosCriptografados;
    }
    
    public static function criptografarSenha($senha) {
        return crypt($senha, '$2a$10$' . self::salt() . '$');;
    }
    
    private static function salt() {
        $string = 'abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789';
        $retorno = '';
        for ($i = 1; $i <= 22; $i++) {
            $rand = mt_rand(1, strlen($string));
            $retorno .= $string[$rand - 1];
        }
        return $retorno;
    }
}

