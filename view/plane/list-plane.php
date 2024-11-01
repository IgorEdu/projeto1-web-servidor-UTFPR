<?php 
require_once '../../entities/Plane.php';
require_once '../../infra/ConnectionDB.php';
// $plane1 = new Plane(1, 'a90192', 'airbus', '2018');
// $plane2 = new Plane(2, 'a90289', 'airbus', '2019');
$db = ConnectionDB::getInstance();
$query = $db->prepare("SELECT * FROM planes");
$query->execute();
$dbplanes = $query->fetchAll(PDO::FETCH_OBJ);
$planes = [];
foreach ($dbplanes as $dbplan) {
    $planes[] = new Plane($dbplan->code, $dbplan->model, $dbplan->total_seats, $dbplan->id );
}
// $planes = [$plane1, $plane2];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Aviões</h1>
    <table border="1">
        <tr>
            <th>Código</th>
            <th>Modelo</th>
            <th>Total de assentos</th>
        </tr>
        <?php foreach ($planes as $plane): ?>
            <tr>
                <td><?= $plane->getCode() ?></td>
                <td><?= $plane->getModel() ?></td>
                <td><?= $plane->getTotalSeats() ?></td>
            </tr>
        <?php endforeach; ?>
        <a href="#">Criar</a>
    </table>
</body>
</html>