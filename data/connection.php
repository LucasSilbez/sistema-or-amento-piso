<?php


$host = 'sql304.infinityfree.com';
$db = 'if0_37542315_orcamentopiso';
$user = 'if0_37542315';
$pass = 'orcamentopiso';


/*
$host = 'localhost';
$db = 'sos';
$user = 'root';
$pass = '';
*/

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro na conexão com o banco de dados: ' . $e->getMessage());
}
?>