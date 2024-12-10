<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X Airlines - Login</title>
    <link rel="stylesheet" href="../../styles/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <div class="border-top my-3"></div>
        <h1>Login</h1>
        <div class="border-top my-3"></div>
        <div class="form-container">
            <form action="/login" method="post" id="login-form">
                <?php if (isset($error) && $error): ?>
                    <div style="background: #fafae1; padding: 15px; margin-bottom: 24px;" id="msg-autenticacao">
                        Usuário não autenticado.
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Usuário: </label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha: </label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <!--            <div>
                <button type="button" id="login-button">Entrar</button>
            </div>
            -->
                <button id="login-button">Entra</button>
                <div>
                    <span>Não possui uma conta?</span>
                    <a href="/signup">Criar</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>