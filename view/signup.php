<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X Airlines - Cadastro</title>
    <link rel="stylesheet" href="../../styles/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <div class="border-top my-3"></div>
        <h1>Cadastro</h1>
        <div class="border-top my-3"></div>
        <div class="form-container">
            <form action="/signup" method="post" id="signup-form">
                <?php if ($exists): ?>
                    <div style="background: #fafae1; padding: 15px; margin-bottom: 24px;" id="msg-cadastro">
                        Usuário já cadastrado!
                    </div>
                <?php endif; ?>
                <div class="container-label">
                    <label for="username">Usuário: </label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="container-label">
                    <label for="password">Senha: </label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="container-label">
                    <label for="password-confirm">Confirme a senha: </label>
                    <input type="password" name="password-confirm" id="password-confirm" class="form-control" required>
                </div>
                <?php if ($error): ?>
                    <div style="background: #fafae1; padding: 15px; margin-bottom: 24px;" id="msg-cadastro">
                        Senhas não são iguais!
                    </div>
                <?php endif; ?>
                <div>
                    <button id="signup-button">Cadastrar</button>
                </div>
                <div>
                    <span>Já possui uma conta?</span>
                    <a href="/login">Acessar</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>