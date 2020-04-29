<?php

class AlunoService {
    
    public static function salvar(Aluno $aluno) {
        $alunoDao = new AlunoDao();
        
        if($aluno->ehNovo()){
            return $alunoDao->inserir($aluno);
        }else{
            return $alunoDao->alterar($aluno);
        }
    }
    
    public static function listar() {
        $alunoDao = new AlunoDao();
        
        return $alunoDao->listar();
    }
}

