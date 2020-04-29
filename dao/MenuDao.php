<?php

class MenuDao {
    
    public function inserir(Menu $menu){
        if(empty($menu)){
            throw new Exception("Variável dados está vazia!", 500);
        }
        
        $valores = array(
            $menu->getNome(),
            $menu->getDescricao(),
            $menu->getGrupo()
        );
        
        $sql = vsprintf("INSERT INTO
                            menuPermissao
                         SET
                            nome = '%s',
                            descricao = '%s',
                            grupo = '%s'", $valores);
        
        Conexao::executarUpdate($sql);
        
        $menu->setId(Conexao::ObterId());
        
        return $menu;
    }
    
    public function alterar(Menu $menu){
        if(empty($menu)){
            throw new Exception("Variável dados está vazia!", 500);
        }
        
        $valores = array(
            $menu->getId(),
            $menu->getNome(),
            $menu->getDescricao(),
            $menu->getGrupo()
        );
        
        $sql = vsprintf("UPDATE
                            menuPermissao
                         SET
                            id = %s,
                            nome = '%s',
                            descricao = '%s',
                            grupo = '%s'
                        WHERE
                            id = %s", $valores);
        
        Conexao::executarUpdate($sql);
        
        return $menu;
    }
    
    public function listar() {
        $sql = "SELECT
                    id,
                    nome,
                    descricao,
                    grupo
                FROM
                    menuPermissao";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        for ($i = 0; $i < count($result); $i++) {
            $menu = new Menu($result[$i]);
            
            $dadosRetorno[] = $menu;
        }
        
        return $dadosRetorno;
    }
    
    public function remover ($id) {
        $sql = "DELETE FROM menuPermissao WHERE id = $id";
        
        if(Conexao::executarQuery($sql)){
            throw new Exception("Erro, não foi possível remover este item do menu!", 500);
        }
        
        return "OK";
    }
}

