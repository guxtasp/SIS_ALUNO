<?php
require_once('../conexao.php');

function getProfessorByIdOrName($conexao, $idOuNome)
{
    $query = 'SELECT * FROM Professor WHERE idProfessor = :idOuNome OR nomeProfessor LIKE :nomePesquisado';
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':idOuNome', $idOuNome, PDO::PARAM_INT);
    $stmt->bindValue(':nomePesquisado', '%' . $idOuNome . '%', PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch();
}

function getAlunosMatriculados($conexao, $codDisciplina)
{
    $query = 'SELECT a.idAluno, a.nomeAluno, a.emailAluno, d.nomeDisciplina, c.nota 
              FROM Aluno a
              JOIN Cursa c ON a.idAluno = c.Aluno_idAluno
              JOIN Disciplina d ON c.Disciplina_codDisciplina = d.codDisciplina
              WHERE d.Professor_idProfessor = :codDisciplina';

    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':codDisciplina', $codDisciplina, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}

function calcularMedia($notas)
{
    if (count($notas) === 0) {
        return 0;
    }
    $totalNotas = array_sum($notas);
    return $totalNotas / count($notas);
}

$professor = null;
$alunosMatriculados = [];

// Verifica se o formulário foi enviado e obtém o ID ou nome do professor
if (isset($_POST['submit'])) {
    $professorIdOuNome = $_POST['identificacaoProfessor'];
    $professor = getProfessorByIdOrName($conexao, $professorIdOuNome);
    if ($professor) {
        $codDisciplina = $professor['idProfessor'];
        $alunosMatriculados = getAlunosMatriculados($conexao, $codDisciplina);
    } else {
        echo "Professor não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Notas</title>
    <style>
    .button > a:hover {
    text-decoration: none;
    color: white;
}
</style>
</head>

<body>
    <section class="direcionador-paginas exclusiva-para-notas">
        <div class="identificacao-section">
            <img src="../assets/logotipo_logo.png" alt="">
            <h1 class="title-section">Acesso ao Sistema</h1>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Infelizmente, essa funcionalidade está em fase de construção devido empecilhos no banco de dados.
            </div>
        </div>
        <hr>
        <?php if (isset($_POST['submit']) && $professor) { ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Infelizmente, essa funcionalidade está em fase de construção.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <form method="POST" action="diarioprofessor.php">
            <label for="identificacaoProfessor">Digite o ID ou Nome do Professor:</label>
            <input type="text" name="identificacaoProfessor" id="identificacaoProfessor" required>
            <button type="submit" class="btn-crud" name="submit">Buscar</button>
        </form>

        <?php if ($professor) { ?>
            <h2>Alunos matriculados na disciplina: <?php echo $professor['nomeProfessor']; ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Disciplina</th>
                        <th>Nota</th>
                        <th>Status</th>
                        <th colspan="2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($alunosMatriculados as $aluno) {
                        $notas = [$aluno['nota']]; // Coloca a nota atual no array de notas
                        // Calcula o status do aluno (aprovado ou reprovado)
                        $media = calcularMedia($notas);
                        $status = $media >= 6 ? 'Aprovado' : 'Reprovado';
                    ?>
                        <tr>
                            <td><?php echo $aluno['idAluno']; ?></td>
                            <td><?php echo $aluno['nomeAluno']; ?></td>
                            <td><?php echo $aluno['emailAluno']; ?></td>
                            <td><?php echo $aluno['nomeDisciplina']; ?></td>
                            <td><?php echo $aluno['nota']; ?></td>
                            <td><?php echo $status; ?></td>
                            <td>
                                <button class="btn-crud btn-diario" data-bs-toggle="modal" data-bs-target="#modalNotas_<?php echo $aluno['idAluno']; ?>">Editar/Adicionar Notas</button>
                            </td>
                        </tr>

                        <!-- Modal para adicionar/editar nota -->
                        <div class="modal fade" id="modalNotas_<?php echo $aluno['idAluno']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalNotasLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalNotasLabel">Editar/Adicionar Notas do Aluno <?php echo $aluno['nomeAluno']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        // Aqui, você pode buscar todas as notas do aluno com idAluno igual a $aluno['idAluno'] e exibi-las
                                        // em um loop. Caso não exista uma nota, você pode exibir um campo vazio para adicionar uma nova nota.
                                        // Exemplo:
                                        $idAluno = $aluno['idAluno'];
                                        $notasDoAluno = []; // Aqui você busca as notas do aluno no banco de dados

                                        // Verifica se existem notas para o aluno
                                        if (count($notasDoAluno) > 0) {
                                            foreach ($notasDoAluno as $index => $nota) {
                                                // Exibe as notas existentes com campos editáveis
                                                $numNota = $index + 1;
                                                echo '<label>Nota ' . $numNota . ': </label><input type="text" value="' . $nota['nota'] . '"><br>';
                                            }
                                        } else {
                                            // Exibe campos vazios para adicionar novas notas
                                            echo '<label>Nota 1: </label><input type="text"><br>';
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="button" class="btn btn-primary">Salvar</button>
                                        <?php
                                        if (count($notasDoAluno) < 2) { // Altere 2 para o número máximo de notas que deseja permitir adicionar
                                            // Exibe botão para adicionar nota somente se o aluno tiver menos de 2 notas
                                            echo '<button type="button" class="btn btn-primary">Adicionar Nota</button>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
        <?php
        echo "<button class='button button3'><a href='acesso-professor.html'>Voltar</a></button>";
        ?>
    </section>
</body>

</html>