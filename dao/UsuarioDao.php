<?php

class UsuarioDao {
    
    public function inserir(Usuario $usuario) {
        if(Empty($usuario)){
            throw new Exception("Variável dados está vazia!", 500);
        }
        
        $dados = array(
            $usuario->getChEsMembro(),
            Encrypt::criptografarSenha($usuario->getSenha())
        );
        
        $sql = vsprintf("INSERT INTO
                            usuarios
                        SET
                            chEsMembro = %s,
                            password = '%s'
                        ", $dados);
        
        Conexao::executarUpdate($sql);
        
        $usuario->setId(Conexao::obterId());
        
        $permissaoService = new PermissaoService();
        
        for ($i = 0; $i < count($usuario->getPermissoes()); $i++) {
            $usuario->getPermissoes()[$i]->setChEsUsuario($usuario->getId());
            
            $permissaoService->salvar($usuario->getPermissoes()[$i]);
        }
        
        return $usuario;
    }
    
    public function alterar(Usuario $usuario) {
        if(Empty($usuario)){
            throw new Exception("Variável dados está vazia!", 500);
        }
        
        $usuarioAnterior = $this->localizar($usuario->getId());
        
        $senha = $usuario->getSenha() == $usuarioAnterior->getSenha() ? $usuarioAnterior->getSenha() : Encrypt::criptografarSenha($usuario->getSenha());
        
        $dados = array(
            $usuario->getId(),
            $usuario->getChEsMembro(),
            $senha,
            $usuario->getId()
        );
        
        $sql = vsprintf("UPDATE
                            usuarios
                        SET
                            id = %s,
                            chEsMembro = %s,
                            password = '%s'
                        WHERE id = %s
                        ", $dados);
        echo $sql;
        Conexao::executarUpdate($sql);
        
        $permissaoService = new PermissaoService();
        
        for ($i = 0; $i < count($usuario->getPermissoes()); $i++) {            
            $permissaoService->salvar($usuario->getPermissoes()[$i]);
        }
        
        return $usuario;
    }
    
    public function login(array $usuario){
        $valor = array(
            $usuario["email"]
        );
        $sql = vsprintf("SELECT 
                    usuarios.id,
                    usuarios.chEsMembro,
                    usuarios.password,
                    membros.nome,
                    contato.email
                FROM 
                    usuarios 
                INNER JOIN 
                    membros ON membros.id=usuarios.chEsMembro 
                INNER JOIN
                    contato on contato.id = membros.chEsContato
                WHERE 
                    contato.email = '%s'
                        ", $valor);
        
        $result = Conexao::executarQuery($sql);

        $login = array();
        if(!Empty($result)){
            if(password_verify($usuario["senha"], $result[0]["password"])){
                $JWTAuth = new JWTAuth();
                
                $dados = array("id" => $result[0]["id"], "nome" => $result[0]["nome"], "email" => $result[0]["email"]);
                
                $token = $JWTAuth->gerarToken($dados);
                
                header("Authorization: Bearer " . $token);
                
                $login = new Login(array("id" => $result[0]["id"], "nomeUsuario" => $result[0]["nome"], 
                "email" => $result[0]["email"], "hash" => $token));
            }else{
                throw new Exception("Senha inválida!", 01);
            }
        }else{
            throw new Exception("Usuário não encontrado!", 02);
        }

        return $login;
    }
    
    public function listar() {
        $sql = "SELECT
                    usuarios.id,
                    usuarios.chEsMembro,
                    usuarios.password as senha,
                    membros.nome as nomeUsuario,
                    contato.email
                FROM
                    usuarios
                INNER JOIN
                    membros ON membros.id=usuarios.chEsMembro
                INNER JOIN
                    contato on contato.id = membros.chEsContato";
        
        $resultado = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $usuario = new Usuario($resultado[$i]);
            $permissaoDao = new PermissaoDao();
            
            $permissoes = $permissaoDao->localizarPorUsuario($usuario->getId());
            
            $usuario->setPermissoes($permissoes);
            
            $dadosRetorno[] = $usuario;
        }
        
        return $dadosRetorno;
    }
    
    public function localizar($id) {
        $sql = "SELECT
                    usuarios.id,
                    usuarios.chEsMembro,
                    usuarios.password as senha,
                    membros.nome as nomeUsuario,
                    contato.email
                FROM
                    usuarios
                INNER JOIN
                    membros ON membros.id=usuarios.chEsMembro
                INNER JOIN
                    contato on contato.id = membros.chEsContato
                WHERE
                    usuarios.id = $id";
        
        $resultado = Conexao::executarQuery($sql);
        
        $retorno = array();
        if(count($resultado) == 1) {
            $retorno = new Usuario($resultado[0]);
            
            $permissaoDao = new PermissaoDao();
            
            $retorno->setPermissoes($permissaoDao->localizarPorUsuario($retorno->getId()));
        }
        
        return $retorno;
    }
    
    public function remover($id) {
        $permissaoService = new PermissaoService();
        
        $permissaoService->removerPorUsuario($id);
        
        $sql = "DELETE FROM usuarios WHERE id = $id";
        
        if(Conexao::executarQuery($sql)){
            throw new Exception("Erro, não foi possível remover este usuário!", 500);
        }
        
        return "OK";
    }    
}