<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X Airlines - Aviões</title>
    <link rel="stylesheet" href="../../styles/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div>
                <a href="/home"><i class="bi bi-house"></i> Início </a>
                <i class="bi bi-arrow-right-short"></i>
                <a href="/ticketSale"><i class="bi bi-ticket"></i> Venda de Passagens</a>
            </div>
            <a href="/logout"><i class="bi bi-box-arrow-right"></i> Sair</a>
        </div>
        <div class="border-top my-3"></div>
        <h1>Venda de Passagens</h1>
        <div class="border-top my-3"></div>

        <div class="border-top my-3"></div>
        <table class="table table-hover" style="text-align: center;">
            <thead>
                <tr>
                    <th scope="col">Mês</th>
                    <th scope="col">Passagens Vendidas</th>
                    <th scope="col">Valor Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($occupationSummary) && is_array($occupationSummary)): ?>
                    <?php foreach ($occupationSummary as $summary): ?>
                        <tr>
                            <td class="uppercase"><?= $summary->getMonth() ?></td>
                            <td><?= $summary->getSoldTickets() ?></td>
                            <td><?= $summary->getTotalSum() ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Não há nada para ser exibido.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>