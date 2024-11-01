<?php require("../controller/login.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="form-container">
        <form action="login.php" method="post" id="login-form">
            <div class="form-title">
                <h2>Login</h2>
            </div>
            <?php if ($error) : ?>
                <div style="background: #fafae1; padding: 15px; margin-bottom: 24px;" id="msg-autenticacao">
                    Usuário não autenticado.
                </div>
            <?php endif; ?>
            <div class="container-label">
                <label for="username">Usuário: </label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="container-label">
                <label for="password">Senha: </label>
                <input type="password" name="password" id="password" required>
            </div>
<!--            <div>
                <button type="button" id="login-button">Entrar</button>
            </div>
            -->
            <button id="login-button">Entra</button>
            <div>
                <span>Não possui uma conta?</span>
                <a href="./signup.php">Criar</a>
            </div>
        </form>
    </div>
</body>
</html>