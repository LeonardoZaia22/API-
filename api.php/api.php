<?php
    header('Content-Type: application/json');

    $usuarios = [
        ["id" => 1, "nome" => "João", "email" => "joao@example.com"],
        ["id" => 2, "nome" => "Maria", "email" => "maria@example.com"]
    ];

    echo json_encode($usuarios);
?>



?>