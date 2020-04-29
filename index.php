<?php
/*
Versão: 1.2.0

*/
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once './config/config.php';

if(isset($_SERVER["REQUEST_URI"])){
    try {
        $url = $_SERVER["REQUEST_URI"];
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $api = new Api($url, $requestMethod);
        $metodoAceito = new MetodoAceito();
        if($metodoAceito->verificar($api->getMetodo(), $requestMethod)){
            $retorno = call_user_func([$api->getService(), $api->getMetodo()], $api->getParametros());
        }else{
            throw new Exception("Método utilizado não permitido!", 405);
        }
    } catch (Exception $e) {        
        switch ($e->getCode()){
            case 401:
            case 402:
                header("HTTP/1.1 401 Unauthorized");
                break;
            case 404:
                header("HTTP/1.1 404 Not Found");
                break;
            case 405: 
                header("HTTP/1.1 405 Method Not Allowed");
                break;
            case 500:
                header("HTTP/1.1 500 Internal Server Error");
                break;
            default:
                header("HTTP/1.1 200 OK");
        }
        echo "{ error: " . $e->getMessage() . "}";
        
        $retorno = $e->getMessage();
    }
    
    //echo $encrypt->criptografar(json_encode(array("status" => $status, "dados" => $retorno)));
    echo json_encode($retorno);
}
