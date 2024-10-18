<?php
include 'connection.php';

function listarDados($tabela) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM $tabela");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function inserirDados($tabela, $dados) {
    global $pdo;
    $campos = implode(', ', array_keys($dados));
    $valores = ':' . implode(', :', array_keys($dados));
    $stmt = $pdo->prepare("INSERT INTO $tabela ($campos) VALUES ($valores)");

    foreach ($dados as $campo => $valor) {
        $stmt->bindValue(":$campo", $valor);
    }

    return $stmt->execute();
}

function obterRegistroPorId($tabela, $id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM $tabela WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



function atualizarDados($tabela, $id, $dados) {
    global $pdo;
    $atualizacoes = implode(', ', array_map(function ($campo) {
        return "$campo = :$campo";
    }, array_keys($dados)));

    $stmt = $pdo->prepare("UPDATE $tabela SET $atualizacoes WHERE id = :id");

    foreach ($dados as $campo => $valor) {
        $stmt->bindValue(":$campo", $valor);
    }

    $stmt->bindValue(":id", $id);

    return $stmt->execute();
}

function excluirDados($tabela, $id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM $tabela WHERE id = :id");
    $stmt->bindValue(":id", $id);
    return $stmt->execute();
}
?>