<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
<body>
    <h1>Bem-vindo ao PHP Playground!</h1>

    <h2>Lista de Usuários:</h2>
    <ul>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <li>
                    <strong>Nome:</strong> <?= htmlspecialchars($user['name']) ?> <br>
                    <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum usuário encontrado.</p>
        <?php endif; ?>
    </ul>
</body>
</html>
