<?php
require_once "dao/ReservaDAO.php";
require_once "dao/TurmaDAO.php";

// Lógica de agrupamento das reservas
$reservaDAO = new ReservaDAO();
$reservas = $reservaDAO->getAll();

$manha = [];
$tarde = [];
$noite = [];

$turmaDAO = new TurmaDAO();
//print_r($reservas);
foreach ($reservas as $reserva) {
    $turma = $turmaDAO->getById($reserva->getTurma_id());

    if ($turma) {
        switch ($turma->getPeriodo()) {
            case 'Manhâ':
                $manha[] = $reserva;
                break;
            case 'Tarde':
                $tarde[] = $reserva;
                break;
            case 'Noite':
                $noite[] = $reserva;
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas de Sala</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Reservas de Sala</h1>
        <div class="row">
            <div class="col-md-4">
                <h2>Manhã</h2>
                <ul class="list-group">
                    <?php if (count($manha) > 0) : ?>
                        <?php foreach ($manha as $reserva) : ?>
                            <li class="list-group-item">
                                Reserva ID: <?php echo $reserva->getId(); ?><br>
                                Sala ID: <?php echo $reserva->getSala_id(); ?><br>
                                Status: <?php echo $reserva->getStatus(); ?><br>
                                Data Início: <?php echo $reserva->getData_inicio(); ?><br>
                                Data Fim: <?php echo $reserva->getData_fim(); ?><br>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="list-group-item">Nenhuma reserva para este período.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-4">
                <h2>Tarde</h2>
                <ul class="list-group">
                    <?php if (count($tarde) > 0) : ?>
                        <?php foreach ($tarde as $reserva) : ?>
                            <li class="list-group-item">
                                Reserva ID: <?php echo $reserva->getId(); ?><br>
                                Sala ID: <?php echo $reserva->getSala_id(); ?><br>
                                Status: <?php echo $reserva->getStatus(); ?><br>
                                Data Início: <?php echo $reserva->getData_inicio(); ?><br>
                                Data Fim: <?php echo $reserva->getData_fim(); ?><br>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="list-group-item">Nenhuma reserva para este período.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-4">
                <h2>Noite</h2>
                <ul class="list-group">
                    <?php if (count($noite) > 0) : ?>
                        <?php foreach ($noite as $reserva) : ?>
                            <li class="list-group-item">
                                Reserva ID: <?php echo $reserva->getId(); ?><br>
                                Sala ID: <?php echo $reserva->getSala_id(); ?><br>
                                Status: <?php echo $reserva->getStatus(); ?><br>
                                Data Início: <?php echo $reserva->getData_inicio(); ?><br>
                                Data Fim: <?php echo $reserva->getData_fim(); ?><br>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="list-group-item">Nenhuma reserva para este período.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>