<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <title>Notas</title>
    <style>
    </style>
</head>

<body>
    <?php
    require_once('../conexao.php');

    function statusAprovacao($valor) {
        // Verifica se o valor é igual a 1 ou true
        if ($valor >= 6 && !empty($valor)) {
        return "APROVADO";
        } else {
        return "REPROVADO";
        }
       }

    // Verifica se os campos de busca foram preenchidos
    if (isset($_POST['buscar'])) {
        $nomeAluno = $_POST['nomeAluno'];
        $nomeDisciplina = $_POST['nomeDisciplina'];

        // Monta a consulta SQL com os filtros
        $sql = 'SELECT a.nomeAluno, c.nota, d.nomeDisciplina, p.nomeProfessor
                FROM Disciplina d, Professor p, Aluno a, Cursa c
                WHERE c.Aluno_idAluno = a.idAluno 
                AND d.Professor_idProfessor = p.idProfessor 
                AND c.Disciplina_codDisciplina = d.codDisciplina';

        if (!empty($nomeAluno)) {
            $sql .= ' AND a.nomeAluno LIKE :nomeAluno';
        }

        if (!empty($nomeDisciplina)) {
            $sql .= ' AND d.nomeDisciplina LIKE :nomeDisciplina';
        }

        $sql .= ' ORDER BY a.nomeAluno';

        // Executa a consulta com os filtros
        $retorno = $conexao->prepare($sql);

        if (!empty($nomeAluno)) {
            $retorno->bindValue(':nomeAluno', $nomeAluno . '%');
        }

        if (!empty($nomeDisciplina)) {
            $retorno->bindValue(':nomeDisciplina', '%' . $nomeDisciplina . '%');
        }

        $retorno->execute();
    } else {
        // Caso não haja busca, não exibirá dados
        $retorno = null;
    }
    ?>
    <section class="direcionador-paginas" id="lista-usuario">
        <div class="identificacao-section">
            <img src="assets/logotipo_logo.png" alt="">
            <h1 class="title-section">Notas</h1>
        </div>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
                Infelizmente, essa funcionalidade está em fase de construção devido empecilhos no banco de dados.
            </div>
        <hr>
        <form method="POST">
            <div class="form-group">
                <label for="nomeAluno">Nome do Aluno:</label>
                <input class="form-control" type="text" id="nomeAluno" name="nomeAluno">
            </div>
            <div class="form-group">
                <label for="nomeDisciplina">Nome da Disciplina:</label>
                <input class="form-control" type="text" id="nomeDisciplina" name="nomeDisciplina">
            </div>
            <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
        </form>
        <?php if ($retorno) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>NOME DO ALUNO</th>
                        <th>NOTA</th>
                        <th>DISCIPLINA</th>
                        <th>PROFESSOR</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($retorno->fetchall() as $value) { ?>
                        <tr>
                            <td><?php echo $value['nomeAluno'] ?></td>
                            <td><?php echo $value['nota'] ?></td>
                            <td><?php echo $value['nomeDisciplina'] ?></td>
                            <td><?php echo $value['nomeProfessor'] ?></td>
                            <td><?php echo statusAprovacao($value['nota']) ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Nenhum resultado encontrado.</p>
        <?php } ?>
        <?php
        echo "<button class='btn btn-primary'><a href='acesso-aluno.html' class='btn-white-text'>Voltar</a></button>";
        ?>
    </section>
</body>

</html>
