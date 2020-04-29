<?php

class ModuloDao {
    
    public function inserir(Modulo $modulo) {
       
    }
    
    public function alterar(Modulo $modulo) {
        
    }
    
    public function listar() {
        $sql = "SELECT
                    id,
                    modulo,
                    ordem
                FROM
                    modulos";
        
        $resultado = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        
        for ($i = 0; $i < count($resultado); $i++) {
            $modulo = new Modulo($resultado[$i]);
            
            $dadosRetorno[] = $modulo;
        }
        
        return $dadosRetorno;
    }
}

