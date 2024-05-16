<?php
require_once "dao/ReservaDAO.php";
require_once "entity/Reserva.php";
require_once "dao/TurmaDAO.php";

//$reservaDAO = new ReservaDAO();
$dataInicio = date("Y-m-d H:i:s");
$datafim  = date("Y-m-d H:i:s");
//$reserva = new Reserva(4, 1, 2, "Livre", $dataInicio, $datafim, "");

//print_r($reservaDAO->create($reserva));
//print_r($reservaDAO->delete(2));
// print_r($reserva);

$turmaDAO = new TurmaDAO();
$turmas = $turmaDAO->getAll();
$reservaDAO = new ReservaDAO();
$reservas = $reservaDAO->getAll();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $turmaId = $_POST['turma_id'];
    $dataInicio = $_POST['data_inicio'];
    $dataFim = $_POST['data_fim'];

    $inserido = $reservaDAO->create($turmaId, $dataInicio, $dataFim);
    if ($inserido) {
        echo "Reserva inserida com sucesso!";
    } else {
        echo "Erro ao inserir a reserva.";
    }
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
                <label for="turma_id" class="form-label">Turma</label>
                <select class="form-select" id="turma_id" name="turma_id" required>
                    <?php foreach ($turmas as $turma) : ?>
                        <option value="<?php echo $turma->getId(); ?>"><?php echo $turma->getCod_Turma(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="sala_id" class="form-label">Sala Id</label>
                <input type="number" class="form-control" id="sala_id" name="sala_id" value="<?php ?>" required>
            </div>
            <div class="mb-3">
                <label for="data_inicio" class="form-label">Data Início</label>
                <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
            </div>
            <div class="mb-3">
                <label for="data_fim" class="form-label">Data Fim</label>
                <input type="date" class="form-control" id="data_fim" name="data_fim" required>
            </div>
            <button type="submit" class="btn btn-primary">Inserir Reserva</button>
        </form>
    </div>
</body>

</html>