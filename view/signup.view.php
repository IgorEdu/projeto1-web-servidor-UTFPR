<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="form-container">
        <form action="" method="post" id="login-form">
            <div class="form-title">
                <h2>Cadastro</h2>
            </div>
            <div id="msg-cadastro" hidden>
                <p>Usuário já cadastrado!</p>
            </div>
            <div class="container-label">
                <label for="username">Usuário: </label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="container-label">
                <label for="password">Senha: </label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="container-label">
                <label for="password-confirm">Confirme a senha: </label>
                <input type="password" name="password-confirm" id="password-confirm" required>
            </div>
            <div>
                <button type="button" id="signup-button">Cadastrar</button>
            </div>
            <div>
                <span>Já possui uma conta?</span>
                <a href="#">Criar</a>
            </div>
        </form>
    </div>
</body>
</html>