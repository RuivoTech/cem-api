<?php

class MetodoAceito {
    private const GET = array(
        "localizar",
        "listar",
        "listarAniversariante"
    );

    private const POST = array(
        "salvar",
        "inserir",
        "login",
        "alterarPermissao"
    );

    private const DELETE = array(
        "remover",
        "deletar",
        "excluir",
    );

    private const PUT = array(
        "alterar",
    );

    public function verificar($metodo, $metodoArray){
        return in_array($metodo, constant("self::$metodoArray"));
    }
}