<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X Airlines - Login</title>
    <style>
        body {
            background-color: #f0f0f0 !important;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            height: 85vh;
            width: 80%;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            overflow-y: auto;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 20px;
        }

        .header a {
            margin-left: 5px;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        h1 {
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 8px;
            margin: 10px;
            font-size: 24px;
            color: #333;
        }

        .uppercase {
            text-transform: uppercase;
        }
    </style>
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