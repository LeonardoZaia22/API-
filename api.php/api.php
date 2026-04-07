<?php
//CABEÇALHO
header("Content-Type: application/json"); // Define o tipo de resposta

$metodo = $_SERVER['REQUEST_METHOD'];

//echo "Método da requisição: " . $metodo;

switch ($metodo) {
    case 'GET':
        echo "AQUI AÇÕES DO MÉTODO GET";
        break;

    case 'POST':
        echo "AQUI AÇÕES DO MÉTODO POST";
        break;

    default:
        echo "MÉTODO NÃO ENCONTRADO!";
        break;
}
?>
