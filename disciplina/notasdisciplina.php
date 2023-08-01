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
    <title>Document</title>
</head>

<body>
    <?php

    require_once('../conexao.php');

    $retorno = $conexao->prepare('SELECT a.nomeAluno, c.nota, d.nomeDisciplina, p.nomeProfessor
FROM Disciplina d, Professor p, Aluno a, Cursa c
WHERE c.Aluno_idAluno = a.idAluno and d.Professor_idProfessor = p.idProfessor and c.Disciplina_codDisciplina = d.codDisciplina  order by nomeAluno');
    $retorno->execute();

    ?>
    <section class="direcionador-paginas" id="lista-usuario">
        <div class="identificacao-section">
            <img src="assets/logotipo_logo.png" alt="">
            <h1 class="title-section">Notas</h1>
        </div>
        <hr>
        <input class="form-control" id="myInput" type="text" placeholder="Procurar..">
        <table>
            <thead>
                <tr>
                    <th>NOME DO ALUNO</th>
                    <th>NOTA</th>
                    <th>DISCIPLINA</th>
                    <th>PROFESSOR</th>
                </tr>
            </thead>

            <tbody id="myTable">
                <tr>
                    <?php foreach ($retorno->fetchall() as $value) { ?>
                <tr>
                    <td> <?php echo $value['nomeAluno'] ?> </td>
                    <td> <?php echo $value['nota'] ?> </td>
                    <td> <?php echo $value['nomeDisciplina'] ?> </td>
                    <td> <?php echo $value['nomeProfessor'];?>
                    </td>
                </tr>
            <?php  }  ?>
            </tr>
            </tbody>
        </table>
        </div>
        <?php
        echo "<button class='button button3'><a href='acesso-disciplina.html'>Voltar</a></button>";
        ?>
    </section>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>