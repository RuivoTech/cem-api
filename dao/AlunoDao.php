<?php

class AlunoDao {
    
    public function inserir(Aluno $aluno) {
        $dados = array(
            $aluno->getNome(),
            $aluno->getEmail(),
            $aluno->getRg(),
            $aluno->getTelefone(),
            $aluno->getEndereco()
        );
        
        $sql = vsprintf("INSERT INTO 
                            alunos
                        SET
                            nome = '%s',
                            email = '%s',
                            rg = '%s',
                            telefone = '%s',
                            endereco = '%s'", $dados);
        
        Conexao::executarUpdate($sql);
        
        $aluno->setId(Conexao::obterId());
        
        return $aluno;
    }
    
    public function alterar(Aluno $aluno) {
        $dados = array(
            $aluno->getId(),
            $aluno->getNome(),
            $aluno->getEmail(),
            $aluno->getRg(),
            $aluno->getTelefone(),
            $aluno->getEndereco(),
            $aluno->getId()
        );
        
        $sql = vsprintf("UPDATE
                            alunos
                        SET
                            id = '%s',
                            nome = '%s',
                            email = '%s',
                            rg = '%s',
                            telefone = '%s',
                            endereco = '%s'
                        WHERE 
                            id = '%s'", $dados);
        
        Conexao::executarUpdate($sql);
        
        return $aluno;
    }
    
    public function listar() {
        $sql = "SELECT 
                    id,
                    nome,
                    email,
                    rg,
                    telefone,
                    endereco
                FROM
                    alunos";
        
        $resultado = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        
        for ($i = 0; $i < count($resultado); $i++) {
            $aluno = new Aluno($resultado[$i]);
            
            $dadosRetorno[] = $aluno;
        }
        
        return $dadosRetorno;
    }
}

