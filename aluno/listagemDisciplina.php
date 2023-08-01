
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>

<body>
<?php

require_once('../conexao.php');

$retorno = $conexao->prepare('SELECT d.codDisciplina, d.nomeDisciplina, d.cargaHoraria, p.nomeProfessor, d.Professor_idProfessor
FROM Disciplina d, Professor p
WHERE d.Professor_idProfessor = p.idProfessor order by nomeDisciplina');
$retorno->execute();

?>
    <section class="direcionador-paginas" id="lista-usuario">
        <div class="identificacao-section">
            <img src="assets/logotipo_logo.png" alt="">
            <h1 class="title-section">Lista de Disciplinas</h1>
        </div>
        <hr>
        <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>CARGA HORÁRIA</th>
                <th>PROFESSOR</th>
                <th colspan="2">AÇÕES</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <?php foreach ($retorno->fetchall() as $value) { ?>
            <tr>
                <td> <?php echo $value['codDisciplina'] ?> </td>
                <td> <?php echo $value['nomeDisciplina'] ?> </td>
                <td> <?php echo $value['cargaHoraria'] ?> </td>
                <td> <?php echo $value['nomeProfessor'];
                echo " -"?> 
                <?php echo $value['Professor_idProfessor'] ?> 
            </td>
                <td>
                    <form method="POST" action="matricularDisciplina.php">
                        <input name="codDisciplina" id="professor"  type="hidden" value="<?php echo $value['codDisciplina']; ?>" />
                        <button name="alterar" type="submit" class="btn-crud">Matricular</button>
                    </form>
                </td>
            </tr>
        <?php  }  ?>
        </tr>
        </tbody>
    </table>
        </div>
        <?php
echo "<button class='button button3'><a href='acesso-aluno.html'>Voltar</a></button>";
?>
    </section>

</body>
