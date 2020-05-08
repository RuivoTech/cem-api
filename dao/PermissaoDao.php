<?php

class PermissaoDao {
    public function inserir(Permissao $permissao){
        if(Empty($permissao)){
            throw new Exception("Variável dados está vazia!", 500);
        }
        
        $valores = array(
            $permissao->getChEsUsuario(),
            $permissao->getChEsMenuPermissao(),
            $permissao->getPermissao()
        );
        
        $sql = vsprintf("INSERT INTO
                            permissao
                         SET
                            chEsUsuario = %s,
                            chEsMenuPermissao = %s,
                            permissao = %s", $valores);
        
        Conexao::executarUpdate($sql);
        echo $sql;
        $permissao->setId(Conexao::ObterId());
        
        return $permissao;
    }
    
    public function alterar(Permissao $permissao){
        if(Empty($permissao)){
            throw new Exception("Variável dados está vazia!", 500);
        }
        
        $valores = array(
            $permissao->getId(),
            $permissao->getChEsUsuario(),
            $permissao->getChEsMenuPermissao(),
            $permissao->getPermissao(),
            $permissao->getId()
        );
        
        $sql = vsprintf("UPDATE
                            permissao
                         SET
                            id = %s,
                            chEsUsuario = %s,
                            chEsMenuPermissao = %s,
                            permissao = %s
                        WHERE
                            id = %s", $valores);
        
        Conexao::executarUpdate($sql);
        echo $sql;
        return $permissao;
    }
    
    public function listar() {
        $sql = "SELECT
                    id,
                    chEsUsuario,
                    chEsMenuPermissao,
                    permissao
                FROM
                    permissao";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        for ($i = 0; $i < count($result); $i++) {
            $permissao = new Menu($result[$i]);
            
            $dadosRetorno[] = $permissao;
        }
        
        return $dadosRetorno;
    }
    
    public function localizar($id) {
        $sql = "SELECT
                    id,
                    chEsUsuario,
                    chEsMenuPermissao,
                    permissao
                FROM
                    permissao
                WHERE
                    id = $id";
        
        $result = Conexao::executarQuery($sql);
        
        $permissao = new Permissao();
        if(!Empty($result)){
            $permissao = new Permissao($result[0]);
        }
        
        return $permissao;
    }
    
    public function localizarPorUsuario($id) {
        $sql = "SELECT
                    p.id,
                    p.chEsUsuario,
                    p.chEsMenuPermissao,
                    p.permissao,
                    m.nome as menuPermissao,
                    m.grupo as grupoMenuPermissao
                FROM
                    permissao p
                INNER JOIN 
                    menuPermissao m ON m.id = p.chEsMenuPermissao
                WHERE
                    chEsUsuario = $id";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        
        for ($i = 0; $i < count($result); $i++) {
            $permissao = new Permissao($result[$i]);
            
            $dadosRetorno[] = $permissao;
        }
        
        return $dadosRetorno;
    }
    
    public function remover ($id) {
        $sql = "DELETE FROM permissao WHERE id = $id";
        
        if(Conexao::executarQuery($sql)){
            throw new Exception("Erro, não foi possível remover esta permissão!", 500);
        }
        
        return "OK";
    }
    
    public function removerPorUsuario($id) {
        $sql = "DELETE FROM permissao WHERE chEsUsuario = $id";
        
        if(Conexao::executarQuery($sql)){
            throw new Exception("Erro, não foi possível remover esta permissão!", 500);
        }
        
        return "OK";
    }
}

