<?php

class MinisterioDao {
    
    public function inserir(Ministerio $ministerio){
        if(empty($ministerio)){
            throw new Exception("Vari�vel dados est� vazia!", 500);
        }
        
        $valores = array(
            $ministerio->getNome(),
            $ministerio->getDescricao()
        );
        
        $sql = vsprintf("INSERT INTO
                            ministerios
                         SET
                            nome = '%s',
                            descricao = '%s'", $valores);
        
        Conexao::executarUpdate($sql);
        
        $ministerio->setId(Conexao::ObterId());
        
        return $ministerio;
    }
    
    public function alterar(Ministerio $ministerio){
        if(empty($ministerio)){
            throw new Exception("Vari�vel dados est� vazia!", 500);
        }
        
        $valores = array(
            $ministerio->getId(),
            $ministerio->getNome(),
            $ministerio->getDescricao(),
            $ministerio->getId()
        );
        
        $sql = vsprintf("UPDATE
                            ministerios
                         SET
                            id = %s,
                            nome = '%s',
                            descricao = '%s'
                        WHERE
                            id = %s", $valores);
        
        Conexao::executarUpdate($sql);
        
        return $ministerio;
    }
    
    public function listar() {
        $sql = "SELECT
                    *
                FROM
                    ministerios";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        for ($i = 0; $i < count($result); $i++) {
            $ministerio = new Ministerio($result[$i]);
            
            $dadosRetorno[] = $ministerio;
        }
        
        return $dadosRetorno;
    }
    
    public function localizar($id) {
        $sql = "SELECT
                    *
                FROM
                    ministerios
                WHERE";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        for ($i = 0; $i < count($result); $i++) {
            $ministerio = new Ministerio($result[$i]);
            
            $dadosRetorno[] = $ministerio;
        }
        
        return $dadosRetorno;
    }
    
    public function localizarMinisterioPorMembro($id) {
        $sql = "SELECT
                    m.id,
                    m.nome,
                    m.descricao
                FROM 
                    ministerios m
                INNER JOIN 
                    ministerioMembro mm ON mm.chEsMinisterio = m.id
                WHERE 
                    mm.chEsMembro =" . $id;
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = [];
        for ($i = 0; $i < count($result); $i++) {
            $ministerio = new Ministerio($result[$i]);
            
            $dadosRetorno[] = $ministerio;
        }
        
        return $dadosRetorno;
    }
    
    public function remover ($id) {
        $sql = "DELETE FROM ministerios WHERE id = $id";
        
        if(Conexao::executarQuery($sql)){
            throw new Exception("Erro, não foi possível remover este ministerio!", 500);
        }
        
        return "OK";
    }
}

