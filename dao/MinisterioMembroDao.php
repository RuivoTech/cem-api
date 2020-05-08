<?php

class MinisterioMembroDao {

    public function inserir(MinisterioMembro $ministerioMembro){
        if(empty($ministerioMembro)){
            throw new Exception("Variável dados está vazia!", 500);
        }
        
        $valores = array(
            $ministerioMembro->getChEsMembro(),
            $ministerioMembro->getChEsMinisterio(),
            $ministerioMembro->getChecked()
        );
        
        $sql = vsprintf("INSERT INTO
                            ministerioMembro
                         SET
                            chEsMembro = %s,
                            chEsMinisterio = %s,
                            checked = %s", $valores);
        
        Conexao::executarUpdate($sql);
        echo $sql;
        $ministerioMembro->setId(Conexao::ObterId());
        
        return $ministerioMembro;
    }
    
    public function alterar(MinisterioMembro $ministerioMembro){
        if(empty($ministerioMembro)){
            throw new Exception("Variável dados está vazia!", 500);
        }
        
        $valores = array(
            $ministerioMembro->getId(),
            $ministerioMembro->getChEsMembro(),
            $ministerioMembro->getChEsMinisterio(),
            $ministerioMembro->getChecked(),
            $ministerioMembro->getId()
        );
        
        $sql = vsprintf("UPDATE
                            ministerioMembro
                         SET
                            id = %s,
                            chEsMembro = %s,
                            chEsMinisterio = %s,
                            checked = %s
                        WHERE
                            id = %s", $valores);
        echo $sql;
        Conexao::executarUpdate($sql);
        
        return $ministerioMembro;
    }
    
    public function listar() {
        $sql = "SELECT
                    id,
                    chEsMembro,
                    chEsMinisterio,
                    checked
                FROM
                    ministerioMembro";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        for ($i = 0; $i < count($result); $i++) {
            $ministerioMembro = new MinisterioMembro($result[$i]);
            
            $dadosRetorno[] = $ministerioMembro;
        }
        
        return $dadosRetorno;
    }
    
    public function localizar($id) {
        $sql = "SELECT
                    id,
                    chEsMembro,
                    chEsMinisterio,
                    checked
                FROM
                    ministerioMembro
                WHERE
                    id = $id";
        
        $result = Conexao::executarQuery($sql);
        
        $ministerioMembro = new MinisterioMembro();
        if(!Empty($result)){
            $ministerioMembro = new MinisterioMembro($result[0]);
        }
        
        return $ministerioMembro;
    }
    
    public function localizarPorMembro($id) {
        $sql = "SELECT
                    id,
                    chEsMembro,
                    chEsMinisterio,
                    case when checked then true else false end as checked
                FROM
                    ministerioMembro
                WHERE
                    chEsMembro = $id";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        
        for ($i = 0; $i < count($result); $i++) {
            $ministerioMembro = new MinisterioMembro($result[$i]);
            
            $dadosRetorno[] = $ministerioMembro;
        }
        
        return $dadosRetorno;
    }

    public function removerPorMembro($id) {
        $sql = "DELETE FROM ministerioMembro WHERE chEsMembro = $id";

        if(Conexao::executarQuery($sql)){
            throw new Exception("Erro, não foi possível remover este ministério!", 500);
        }
        
        return "OK";
    }
}