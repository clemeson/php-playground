<?php
    
require_once __DIR__ . '/../vendor/autoload.php';  // Carrega o autoloader do Composer

use Dotenv\Dotenv;
use App\Controllers\UserController;
use App\Services\UserService;
use App\Models\User;

// Inicializa e carrega as variáveis do arquivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();



// Inclui o arquivo de conexão com o banco de dados e captura o PDO
$pdo = require_once __DIR__ . '/../config/database.php';
$controller = new UserController($pdo);

$route = isset($_GET['route']) ? $_GET['route'] : '/';
error_log("Rota capturada: $route");
switch ($route) {
    case '/':
        echo $controller->index();
        break;
    case 'create':
        echo $controller->create();
        break;
    case 'edit':
        $id = $_GET['id'] ?? null;
        echo $controller->edit($id);
        break;
    default:
        http_response_code(404);
        echo 'Página não encontrada';
        break;
}



use App\Controllers\HomeController;  // Importa o controlador

// Inicializa o controlador e renderiza a view
// Inicializa o controlador e passa o argumento para o método index()



try {
    // Executa uma consulta para verificar a hora atual no MySQL
    $stmt = $pdo->query('SELECT NOW() AS `current_time`');

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Exemplo: Acessar uma variável de ambiente

    if ($result) {
        echo "Conexão bem-sucedida! Hora atual no banco: " . $result['current_time'];
    } else {
        echo "Nenhum resultado retornado.";
    }
} catch (PDOException $e) {
    echo "Erro ao executar consulta: " . $e->getMessage();
}




