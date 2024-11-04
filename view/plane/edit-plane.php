<?php
require_once 'infra/ConnectionDB.php';
require_once 'entities/Plane.php';

if (isset($_GET['id'])) {
    $planeId = $_GET['id'];
    $db = ConnectionDB::getInstance();
    $query = $db->prepare("SELECT * FROM planes WHERE id = :id");
    $query->bindParam(':id', $planeId);
    $query->execute();
    $dbplane = $query->fetch(PDO::FETCH_OBJ);

    if ($dbplane) {
        $plane = new Plane($dbplane->code, $dbplane->model, $dbplane->total_seats, $dbplane->id);
    } else {
        echo "Avião não encontrado.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="form-container">
        <div class="form-title">
            <h2>Detalhes do avião</h2>
        </div>
        <form action="/plane/gravar" method="POST">
            <input type="hidden" id="id" name="id" <?php if(isset($_GET['id'])) : ?> value="<?= $plane->getId() ?>" <?php endif;?>>
            <div class="container-label">
                <label for="code">Código do avião</label>
                <input type="text" id="code" name="code" <?php if(isset($_GET['id'])) : ?> value="<?= $plane->getCode() ?>" <?php endif;?>>
            </div>
            <div class="container-label">
                <label for="model">Modelo do avião</label>
                <input type="text" id="model" name="model" <?php if(isset($_GET['id'])) : ?> value="<?= $plane->getModel() ?>" <?php endif;?>>
            </div>
            <div class="container-label">
                <label for="totalSeats">Quantidade total de assentos</label>
                <input type="number" id="totalSeats" name="totalSeats" <?php if(isset($_GET['id'])) : ?> value="<?= $plane->getTotalSeats() ?>" <?php endif;?>>
            </div>
            <input type="submit" value="Enviar">
        </form>
        <a href="/plane/listar">Cancelar</a>
    </div>

</html>