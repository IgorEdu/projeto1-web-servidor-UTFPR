<?php
    require(__DIR__ . "/createModal.php");
    require (__DIR__ . "/confirmationModal.php");
    require (__DIR__ . "/informationModal.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X Airlines - Voos</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <a href="/home"><i class="bi bi-house"></i> Início </a>
            <i class="bi bi-arrow-right-short"></i>
            <a href="/flight"><i class="bi bi-ticket"></i> Voos</a>
        </div>
        <a href="/logout"><i class="bi bi-box-arrow-right"></i> Sair</a>
    </div>

    <div class="border-top my-3"></div>
    <h1>Voos</h1>
    <div class="border-top my-3"></div>
    <div class="d-flex justify-content-end" style="margin-right: 1vh;">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#flightModal"
                onclick="clean()">
                Novo
        </button>
    </div>
    <div class="border-top my-3"></div>
    <table class="table table-hover" style="text-align: center;">
        <thead>
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Data de Partida</th>
                <th scope="col">Horário de Partida</th>
                <th scope="col">Destino</th>
                <th scope="col">Preço da Passagem</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($flightList) && is_array($flightList)): ?>
            <?php foreach ($flightList as $flight): ?>
                <tr>
                    <td class="uppercase"><?= $flight->getCode() ?></td>
                    <td><?= date('d/m/Y', strtotime($flight->getDepartureDate())) ?></td>
                    <td><?= date('H:i', strtotime($flight->getDepartureTime())) ?></td>
                    <td><?= $flight->getDestination() ?></td>
                    <td><?= $flight->getTicketPrice() ?></td>
                    <td>
                        <div class="dropdown">
                            <button style="border: none; background-color: transparent;" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="">
                                <li>
                                    <a class="dropdown-item text-primary"
                                       href="#"
                                       onclick="openModal(<?php echo $flight->getId(); ?>)">
                                        Editar
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger"
                                       href="#"
                                       onclick="openConfirmationModal(<?php echo $flight->getId(); ?>)">
                                        Excluir
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Nenhum voo encontrado.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
