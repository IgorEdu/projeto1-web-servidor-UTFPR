<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X Airlines</title>
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
        .admin-area {
            height: 40%;
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .admin-section {
            width: 30%;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 8px;
            margin: 10px;
        }
        .admin-section h2 {
            font-size: 20px;
            color: #333;
        }
        .admin-section ul {
            list-style-type: none;
            padding: 0;
        }
        .admin-section ul li {
            margin: 10px 0;
        }
        .admin-section ul li a {
            color: #0066cc;
            text-decoration: none;
        }
        p {
            font-size: larger;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <div class="header">
        <a href="#"><i class="bi bi-house"></i> Início</a>
        <a href="/logout"><i class="bi bi-box-arrow-right"></i> Sair</a>
    </div>
    <div class="border-top my-4"></div>
    <h1>Bem-vindo à X Airlines,<br>Onde a sua viagem é a nossa prioridade</h1>
    <div class="border-top my-4"></div>
    <p>Adquira uma passagem agora usando o botão abaixo!</p>
    <button type="button" class="btn btn-success btn-lg">Comprar Passagem</button>
    <div class="border-top my-4"></div>
    <h5>Área Administrativa</h5>
    <div class="admin-area">
        <div class="admin-section">
            <h2>Buscar</h2>
            <div class="border-top my-4"></div>
            <ul class="list-group">
                <a class="list-group-item list-group-item-action" href="/plane">Aviões</a>
                <a class="list-group-item list-group-item-action" href="/flight">Voos</a>
                <a class="list-group-item list-group-item-action" href="../controller/occupationController.php">Ocupações</a>
            </ul>
        </div>
        <div class="admin-section">
            <h2>Controle</h2>
            <div class="border-top my-4"></div>
            <ul class="list-group">
                <a class="list-group-item list-group-item-action" href="#">Ocupação de Aeronaves</a>
                <a class="list-group-item list-group-item-action" href="#">Vendas de Passagem</a>
            </ul>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
