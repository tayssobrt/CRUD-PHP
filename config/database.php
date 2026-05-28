<?php
function getConnection(): PDO {
    $host   = 'localhost';
    $dbname = 'postgres';
    $user   = 'postgres';
    $pass   = '123456';

    $dsn = "pgsql:host=$host;dbname=$dbname";

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die('Erro na conexão: ' . $e->getMessage());
    }
}