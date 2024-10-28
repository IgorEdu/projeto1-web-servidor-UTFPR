<?php require("../controller/signup.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="form-container">
        <form action="signup.php" method="post" id="login-form">
            <div class="form-title">
                <h2>Cadastro</h2>
            </div>
            <?php if ($exists) : ?>
                <div style="background: #fafae1; padding: 15px; margin-bottom: 24px;" id="msg-cadastro">
                    Usuário já cadastrado!
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
            <div class="container-label">
                <label for="password-confirm">Confirme a senha: </label>
                <input type="password" name="password-confirm" id="password-confirm" required>
            </div>
            <?php if ($error) : ?> 
                <div style="background: #fafae1; padding: 15px; margin-bottom: 24px;" id="msg-cadastro">
                    Senhas não são iguais!
                </div>        
            <?php endif; ?>  
            <div>
                <button id="signup-button">Cadastrar</button>
            </div>
            <div>
                <span>Já possui uma conta?</span>
                <a href="#">Criar</a>
            </div>
        </form>
    </div>
</body>
</html>