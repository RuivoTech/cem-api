<?php

class EventoDao {
    
    public function inserir(Evento $evento){
        if(empty($evento)){
            throw new Exception("Vari�vel dados est� vazia!", 500);
        }
        
        $valores = array(
            $evento->getAtivo(),
            $evento->getDataInicio(),
            $evento->getDataFim(),
            $evento->getDescricao(),
            $evento->getValor()
        );
        
        $sql = vsprintf("INSERT INTO
                            eventos
                         SET
                            ativo = %s,
                            dataInicio = '%s',
                            dataFim = '%s',
                            descricao = '%s',
                            valor = '%s'", $valores);
        
        Conexao::executarUpdate($sql);
        
        $evento->setId(Conexao::ObterId());
        
        return $evento;
    }
    
    public function alterar(Evento $evento){
        if(empty($evento)){
            throw new Exception("Vari�vel dados est� vazia!", 500);
        }
        
        $valores = array(
            $evento->getId(),
            $evento->getAtivo(),
            $evento->getDataInicio(),
            $evento->getDataFim(),
            $evento->getDescricao(),
            $evento->getValor(),
            $evento->getId()
        );
        
        $sql = vsprintf("UPDATE
                            eventos
                         SET
                            id = %s,
                            ativo = %s,
                            dataInicio = '%s',
                            dataFim = '%s',
                            descricao = '%s',
                            valor = '%s'
                        WHERE
                            id = %s", $valores);
        
        Conexao::executarUpdate($sql);
        
        $evento->setId(Conexao::ObterId());
        
        return $evento;
    }
    
    public function listar() {
        $sql = "SELECT
                    *
                FROM
                    eventos";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        for ($i = 0; $i < count($result); $i++) {
            $evento = new Evento($result[$i]);
            
            $dadosRetorno[] = $evento;
        }
        
        return $dadosRetorno;
    }
    
    public function remover ($id) {
        $inscricaoDao = new InscricaoDao();

        $inscricaoDao->removerPorEvento($id);

        $sql = "DELETE FROM eventos WHERE id = $id";
        
        if(Conexao::executarQuery($sql)){
            throw new Exception("Erro, n�o foi poss�vel remover este evento!", 500);
        }
        
        return "OK";
    }
}

