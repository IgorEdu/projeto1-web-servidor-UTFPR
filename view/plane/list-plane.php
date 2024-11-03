<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Aviões</title>
</head>
<body>
    <h1>Aviões</h1>
    <table border="1">
        <tr>
            <th>Código</th>
            <th>Modelo</th>
            <th>Total de assentos</th>
        </tr>
        <?php if (!empty($planes) && is_array($planes)): ?>
            <?php foreach ($planes as $plane): ?>
                <tr>
                    <td><?= $plane->getCode() ?></td>
                    <td><?= $plane->getModel() ?></td>
                    <td><?= $plane->getTotalSeats() ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Nenhum avião encontrado.</td>
            </tr>
        <?php endif; ?>
    </table>
    <a href="edit-plane.php">Criar</a>
</body>
</html>
