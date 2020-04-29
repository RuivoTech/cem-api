<?php

class JWTAuth {
    private const TIPO = "JWT";
    private const ALGORITMO = "HS256";
    private const ISS = "cem.ruivotech.com.br";
    private const CHAVE = "Jesus100%";
    
    public function gerarToken($dados = array()){
        if(empty($dados)){
            throw new Exception("Vari�vel dados est� vazia!");
        }
        
        $cabecalho = $this->gerarCabecalho();
        $carga = $this->gerarCarga($dados);
        $assinatura = $this->gerarAssinatura($cabecalho, $carga);
        
        return $cabecalho . "." . $carga . "." . $assinatura;
    }
    
    public function tokenEhValido($token){
        $parte = explode(".", $token);
        
        $cabecalho = $parte[0];
        $carga = $parte[1];
        $assinatura = $parte[2];
        
        $assinaturaGerada = $this->gerarAssinatura($cabecalho, $carga);
        
        if ($assinatura == $assinaturaGerada) {
            return true;
        }
        
        return false;
    }
    
    private function gerarCabecalho(){
        $cabecalho = json_encode(["typ" => self::TIPO, "alg" => self::ALGORITMO]);
        
        $cabecalho64 = base64_encode($cabecalho);
        
        $resultadoBase64 = str_replace(['+', '/', '='], ['-', '_', ''], $cabecalho64);
        
        return $resultadoBase64;
    }
    
    private function gerarCarga($dados = array()){
        $carga = json_encode([
            "iss" => self::ISS,
            "exp" => date('H:i:s', strtotime('+2 hours', strtotime(date('H:i:s')))),
            "id" => $dados["id"],
            "nome" => $dados["nome"],
            "email" => $dados["email"]
            ]);
        
        $carga64 = base64_encode($carga);
        
        $resultadoBase64 = str_replace(['+', '/', '='], ['-', '_', ''], $carga64);
        
        return $resultadoBase64;
    }
    
    private function gerarAssinatura($cabecalho, $carga) {
        $assinatura = hash_hmac("sha256", $cabecalho . "." . $carga, self::CHAVE, true);
        
        $assinatura64 = base64_encode($assinatura);
        
        $resultadoBase64 = str_replace(['+', '/', '='], ['-', '_', ''], $assinatura64);
        
        return $resultadoBase64;
    }
    
}

