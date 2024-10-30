<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    private $userModel;
    
    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function index()
    {
        $users = $this->userModel->getAllUsers();
        ob_start();
        require __DIR__ . '/../Views/users.php';
        return ob_get_clean();
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
    
            if ($this->userModel->createUser($name, $email, $password)) {
                header('Location: /');  // Redireciona para a lista de usuários
                exit;
            } else {
                echo "Erro ao criar o usuário.";
            }
        }
    
        ob_start();
        require __DIR__ . '/../Views/create_user.php';
        return ob_get_clean();
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];

            $this->userModel->updateUser($id, $name, $email);
            header('Location: /');
            exit;
        }

        $user = $this->userModel->getUserById($id);

        ob_start();
        require __DIR__ . '/../Views/edit_user.php';
        return ob_get_clean();
    }
}
