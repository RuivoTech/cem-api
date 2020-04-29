<?php

class AtividadeDao {
    
    public function inserir(Atividade $atividade) {
        $dados = array(
            $atividade->getDescricao(),
            $atividade->getidTipo(),
            $atividade->getChEsModulo(),
            $atividade->getData()
        );
        
        $sql = vsprintf("INSERT INTO 
                            atividades
                        SET
                            descricao = '%s',
                            idTipo = '%s',
                            chEsModulo = '%s',
                            data = '%s'", $dados);
        
        Conexao::executarUpdate($sql);
        
        $atividade->setId(Conexao::obterId());
        
        return $atividade;
    }
    
    public function alterar(Atividade $atividade) {
        $dados = array(
            $atividade->getId(),
            $atividade->getDescricao(),
            $atividade->getidTipo(),
            $atividade->getChEsModulo(),
            $atividade->getData(),
            $atividade->getId()
        );
        
        $sql = vsprintf("UPDATE
                            atividades
                        SET
                            id = '%s',
                            descricao = '%s',
                            idTipo = '%s',
                            chEsModulo = '%s',
                            data = '%s'
                        WHERE 
                            id = '%s'", $dados);
        
        Conexao::executarUpdate($sql);
        
        return $atividade;
    }
    
    public function listar() {
        $sql = "SELECT 
                    a.id,
                    a.descricao, 
                    a.data, 
                    a.idTipo, 
                    a.chEsModulo,
                    m.modulo 
                from 
                    atividades a
                join 
                    modulos m on a.chEsmodulo = m.id";
        
        $resultado = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        
        for ($i = 0; $i < count($resultado); $i++) {
            $atividade = new Atividade($resultado[$i]);
            
            $dadosRetorno[] = $atividade;
        }
        
        return $dadosRetorno;
    }
    
    public function remover($id) {
        $sql = "DELETE FROM
                    atividades
                WHERE id = $id";
        
        Conexao::executarQuery($sql);
        
        return "OK";
    }
}

