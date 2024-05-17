<?php
require_once "dao/ReservaDAO.php";
require_once "entity/Reserva.php";
require_once "dao/TurmaDAO.php";
require_once "dao/SalaDAO.php";

//$reservaDAO = new ReservaDAO();
$dataInicio = date("Y-m-d H:i:s");
$datafim  = date("Y-m-d H:i:s");





$manha = [];
//print_r($reservas);


function buscar()
{
    $reservaDAO = new ReservaDAO();
    $reservas = $reservaDAO->getAll();
    $turmaDAO = new TurmaDAO();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];

        if ($id) {
            foreach ($reservas as $reserva) {
                $turma = $reserva->getById($id);

                if ($turma) {
                    switch ($turma->getPeriodo()) {
                        case 'Manhâ':
                            $manha[] = $reserva;
                            break;
                        case 'Tarde':
                            $manha[] = $reserva;
                            break;
                        case 'Noite':
                            $manha[] = $reserva;
                            break;
                    }
                }
            }
        } else {
            echo "Erro ao inserir a reserva.";
        }
    }

    return $manha;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Inserir Reserva</h1>
        <form method="POST" action="index.php">

            <div class="mb-3">
                <form method="POST" action="index.php">
                    <div class="mb-3">
                        <label for="id" class="form-label">Insira o Id da Reserva:</label>
                        <input type="number" class="form-control" id="id" name="id" onblur="<?php buscar() ?>" required>
                    </div>
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
                    </div><br>

                    <button type="submit" class="btn btn-primary">Deletar Reserva</button>
                </form>
            </div>
</body>

</html>