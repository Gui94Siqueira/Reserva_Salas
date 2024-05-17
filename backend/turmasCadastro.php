<?php
require_once "dao/DocenteDAO.php";
require_once "dao/TurmaDAO.php";
require_once "entity/Reserva.php";
require_once "entity/Turma.php";
require_once "dao/CursoDAO.php";

$dataInicio = date("Y-m-d H:i:s");
$datafim  = date("Y-m-d H:i:s");


$turmaDAO = new TurmaDAO();
$turmas = $turmaDAO->getAll();
// print_r($turmas);

$cursoDAO = new CursoDAO();
$cursos = $cursoDAO->getAll();
$docenteDAO = new DocenteDAO();
$docentes = $docenteDAO->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $docente = $_POST['docente'];
    $curso = $_POST['curso'];
    $cod_turma = $_POST['cod_turma'];
    $periodo = $_POST['periodo'];

    $new_turma = new Turma(null, $docente, $curso, $cod_turma, $periodo);
    //print_r($new_turma);
    $inserindo = $turmaDAO->create($new_turma);
    if ($inserindo) {
        echo "Turma inserida com sucesso!";
    } else {
        echo "Erro ao inserir a Turma.";
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
        <form method="POST" action="turmasCadastro.php">

            <div class="mb-3">
                <label for="docente" class="form-label">Docente</label>
                <select class="form-select" id="docente" name="docente" required>
                    <?php foreach ($docentes as $docente) : ?>
                        <option value="<?php echo $docente->getId(); ?>"><?php echo $docente->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <select class="form-select" id="curso" name="curso" required>
                    <?php foreach ($cursos as $curso) : ?>
                        <option value="<?php echo $curso->getId(); ?>"><?php echo $curso->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="cod_turma" class="form-label">Código Turma</label>
                <input type="text" class="form-control" placeholder="Insira o código da turma" id="cod_turma" name="cod_turma" required>
            </div>

            <div class="mb-3">
                <label for="periodo" class="form-label">Periodo</label>
                <select class="form-select" id="periodo" name="periodo" required>
                    <option value="Manhã">Manhã</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Noite">Noite</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Inserir Reserva</button>
        </form>
    </div>
</body>

</html>