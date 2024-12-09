<?php
require("createModal.php");
require ("confirmationModal.php");
require ("informationModal.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X Airlines - Ocupações</title>
    <link rel="stylesheet" href="../../styles/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <a href="/home"><i class="bi bi-house"></i> Início </a>
            <i class="bi bi-arrow-right-short"></i>
            <a href="/occupation"><i class="bi bi-ticket"></i> Ocupações</a>
        </div>
        <a href="/logout"><i class="bi bi-box-arrow-right"></i> Sair</a>
    </div>

    <div class="border-top my-3"></div>
    <h1>Ocupações</h1>
    <div class="border-top my-3"></div>
    <div class="d-flex justify-content-end" style="margin-right: 1vh;">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#flightModal" onclick="clean()">
            Novo
        </button>
    </div>
    <div class="border-top my-3"></div>
    <table class="table table-hover" style="text-align: center;">
        <thead>
            <tr>
                <th scope="col">Número do Voo</th>
                <th scope="col">Data de Partida</th>
                <th scope="col">Data da Compra</th>
                <th scope="col">Número do Assento</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($occupations) && is_array($occupations)): ?>
            <?php foreach ($occupations as $occupation): ?>
                <tr>
                    <td class="uppercase"><?= $occupation->getFlightCode() ?></td>
                    <td><?= $occupation->getFlightDepartureDate() ?></td>
                    <td><?= date('d/m/Y', strtotime($occupation->getPurchaseDate())) ?></td>
                    <td><?= $occupation->getSeatNumber() ?></td>
                    <td>
                        <div class="dropdown">
                            <button style="border: none; background-color: transparent;" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="">
                                <li>
                                    <a class="dropdown-item text-primary"
                                       href="#"
                                       onclick="openModal(<?php echo $occupation->getId(); ?>)">
                                        Editar
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger"
                                       href="#"
                                       onclick="openConfirmationModal(<?php echo $occupation->getId(); ?>)">
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
                <td colspan="5">Nenhuma ocupação encontrada.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
