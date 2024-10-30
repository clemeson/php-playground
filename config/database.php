<?php

// Verifica se as variáveis de ambiente foram carregadas corretamente
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_DATABASE'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

try {
    // Monta o Data Source Name (DSN) para a conexão
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    
    // Cria a conexão PDO
    $pdo = new PDO($dsn, $username, $password);
    
    // Configura o modo de erro para lançar exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $pdo;
} catch (PDOException $e) {
    // Exibe erro se a conexão falhar
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
