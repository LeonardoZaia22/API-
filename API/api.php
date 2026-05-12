<?php

header("Content-Type: application/json; charset=UTF-8");

$metodo = $_SERVER['REQUEST_METHOD'];

$arquivo = 'dados_usuarios.json';

// Verifica se o arquivo existe
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Lê os usuários do JSON
$listaUsuarios = json_decode(file_get_contents($arquivo), true);

switch ($metodo) {

    case 'GET':

        echo json_encode(
            $listaUsuarios,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );

        break;

    case 'POST':

        $dados = json_decode(file_get_contents('php://input'), true);

        // Verifica se nome e email foram enviados
        if (!isset($dados['nome']) || !isset($dados['email'])) {

            echo json_encode([
                "erro" => "Nome e email são obrigatórios!"
            ]);

            exit;
        }

        // Gera ID automático
        $novoId = 1;

        if (!empty($listaUsuarios)) {

            $ids = array_column($listaUsuarios, 'id');

            $novoId = max($ids) + 1;
        }

        $usuarioNovo = [

            "id" => $novoId,
            "nome" => $dados['nome'],
            "email" => $dados['email'],
            "idade" => $dados['idade']

        ];

        // Adiciona no array
        array_push($listaUsuarios, $usuarioNovo);

        // Salva no arquivo JSON
        file_put_contents(
            $arquivo,
            json_encode($listaUsuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        echo json_encode([
            "mensagem" => "Usuário cadastrado com sucesso!",
            "usuario" => $usuarioNovo
        ]);

        break;

    case 'PUT':

        echo json_encode([
            "mensagem" => "Método PUT funcionando!"
        ]);

        break;

    case 'DELETE':

        echo json_encode([
            "mensagem" => "Método DELETE funcionando!"
        ]);

        break;

    default:

        echo json_encode([
            "erro" => "Método não permitido!"
        ]);

        break;
}

?>