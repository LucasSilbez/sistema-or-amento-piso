<?php

/*
$host = 'sql100.infinityfree.com';
$db = 'if0_37372284_sos';
$user = 'if0_37372284';
$pass = 'sosorcamento123';
*/


$host = 'localhost';
$db = 'sos';
$user = 'root';
$pass = '';


$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro na conexão com o banco de dados: ' . $e->getMessage());
}
?>