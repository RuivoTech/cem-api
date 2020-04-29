<?php

class DizimoDao {
    
    public function inserir(Dizimo $dizimo) {
        $dados = array(
            $dizimo->getIdMembro(),
            $dizimo->getDataDizimo(),
            $dizimo->getValorDizimo()
        );
        
        $sql = vsprintf("INSERT INTO
                            dizimos
                        SET
                            idMembro = '%s',
                            dataDizimo = '%s',
                            valorDizimo = '%s'", $dados);
        
        Conexao::executarUpdate($sql);
        
        $dizimo->setId(Conexao::obterId());
        
        return $dizimo;
    }
    
    public function alterar(Dizimo $dizimo) {
        $dados = array(
            $dizimo->getId(),
            $dizimo->getIdMembro(),
            $dizimo->getDataDizimo(),
            $dizimo->getValorDizimo(),
            $dizimo->getId()
        );
        
        $sql = vsprintf("UPDATE
                            dizimos
                        SET
                            id = '%s',
                            idMembro = '%s',
                            dataDizimo = '%s',
                            valorDizimo = '%s'
                        WHERE
                            id = '%s'", $dados);
        
        Conexao::executarUpdate($sql);
        
        return $dizimo;
    }
    
    public function listar() {
        $sql = "SELECT 
                    d.id,
                    d.idMembro,
                    d.dataDizimo,
                    d.valorDizimo,
                    m.nome
                FROM 
                    dizimos d
                INNER JOIN 
                    membros m ON m.id = d.idMembro
                ORDER BY m.nome ASC";
        
        $resultado = Conexao::executarQuery($sql);
        
        $retorno = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $dizimo = new Dizimo($resultado[$i]);
            
            $retorno[] = $dizimo;
        }
        
        return $retorno;
    }
    
    public function gerarRelatorio($dados = array()) {
        $sql = "SELECT
                    d.id,
                    d.idMembro,
                    d.dataDizimo,
                    d.valorDizimo,
                    m.nome
                FROM
                    dizimos d
                INNER JOIN
                    membros m ON m.id = d.idMembro";
        
        $sql .= Filtros::montarQuery($dados);
        
        $sql .= " ORDER BY m.nome ASC";
        
        $resultado = Conexao::executarQuery($sql);
        
        $retorno = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $dizimo = new Dizimo($resultado[$i]);
            
            $retorno[] = $dizimo;
        }
        
        return $retorno;
    }
}

