<?php

namespace App\Models;

use PDO;

class User
{
    private $pdo;

    // Construtor que recebe a conexão com o banco de dados
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Método para buscar todos os usuários
    public function getAllUsers()
    {
        $stmt = $this->pdo->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar um usuário pelo ID
    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para criar um novo usuário
    public function createUser($name, $email, $password)
    {
        try {
            // Verifica se os campos não estão vazios
            if (empty($name) || empty($email) || empty($password)) {
                throw new \Exception('Todos os campos são obrigatórios.');
            }

            // Prepara a consulta SQL
            $stmt = $this->pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');

            // Executa a inserção com os dados informados
            $result = $stmt->execute([
                $name, 
                $email, 
                password_hash($password, PASSWORD_DEFAULT)
            ]);

            // Retorna o resultado da operação
            return $result;
        } catch (PDOException $e) {
            // Em caso de erro no banco, exibe o erro
            echo 'Erro ao criar usuário: ' . $e->getMessage();
            return false;
        } catch (\Exception $e) {
            // Em caso de erro na validação, exibe o erro
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }
}
