<?php

class InscricaoDao {
    
    public function inserir(Inscricao $inscricao) {
        $dados = array(
            $inscricao->getNome(),
            $inscricao->getEmail(),
            $inscricao->getCelular(),
            $inscricao->getChEsEvento(),
            $inscricao->getPago()
        );
        
        $sql = vsprintf("INSERT INTO 
                            inscricoes
                        SET
                            nome = '%s',
                            email = '%s',
                            celular = '%s',
                            chEsEvento = '%s',
                            pago = %s", $dados);
        
        Conexao::executarUpdate($sql);
        
        $inscricao->setId(Conexao::obterId());
        
        return $inscricao;
    }
    
    public function alterar(Inscricao $inscricao) {
        $dados = array(
            $inscricao->getId(),
            $inscricao->getNome(),
            $inscricao->getEmail(),
            $inscricao->getCelular(),
            $inscricao->getChEsEvento(),
            $inscricao->getPago(),
            $inscricao->getId()
        );
        
        $sql = vsprintf("UPDATE
                            inscricoes
                        SET
                            id = '%s',
                            nome = '%s',
                            email = '%s',
                            celular = '%s',
                            chEsEvento = '%s',
                            pago = %s
                        WHERE
                            id = '%s'", $dados);
        
        Conexao::executarUpdate($sql);
        
        return $inscricao;
    }
    
    public function listar() {
        $sql = "SELECT 
                    i.id,
                    i.nome,
                    i.email,
                    i.celular,
                    i.chEsEvento,
                    i.pago,
                    e.descricao as evento
                FROM
                    inscricoes i
                INNER JOIN
                    eventos e ON e.id = i.chEsEvento
                ORDER BY i.nome ASC";
        
        $resultado = Conexao::executarQuery($sql);
        
        $retorno = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $inscricao = new Inscricao($resultado[$i]);
            
            $retorno[] = $inscricao; 
        }
        
        return $retorno;
    }

    public function remover($id) {
        $sql = "DELETE FROM inscricoes WHERE id = $id";
        
        if(Conexao::executarQuery($sql)){
            throw new Exception("Erro, não foi possável remover este evento!", 500);
        }
        
        return "OK";
    }

    public function removerPorEvento($id) {
        $sql = "DELETE FROM inscricoes WHERE chEsEvento = $id";
        
        if(Conexao::executarQuery($sql)){
            throw new Exception("Erro, não foi possável remover este evento!", 500);
        }
        
        return "OK";
    }
}

