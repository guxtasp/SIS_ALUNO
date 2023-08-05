<?php
require_once('../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idAluno = $_POST['idAluno'];
    $codDisciplina = $_POST['codDisciplina'];

    // Verificar se o aluno e a disciplina existem
    $verificarAluno = $conexao->prepare('SELECT idAluno FROM Aluno WHERE idAluno = :idAluno OR nomeAluno = :idAluno');
    $verificarAluno->bindParam(':idAluno', $idAluno);
    $verificarAluno->execute();
    $aluno = $verificarAluno->fetch(PDO::FETCH_ASSOC);

    $verificar_disciplina = $conexao->prepare('SELECT codDisciplina FROM Disciplina WHERE codDisciplina = :codDisciplina');
    $verificar_disciplina->bindParam(':codDisciplina', $codDisciplina);
    $verificar_disciplina->execute();
    $disciplina = $verificar_disciplina->fetch(PDO::FETCH_ASSOC);

    if (!$aluno || !$disciplina) {
        echo "Aluno ou disciplina não encontrados. Verifique os IDs ou nomes inseridos.";
    } else {
        // Realizar a matrícula
        $matricular = $conexao->prepare('INSERT INTO Cursa (Aluno_idAluno, Disciplina_codDisciplina) VALUES (:idAluno, :codDisciplina)');
        $matricular->bindParam(':idAluno', $aluno['idAluno']);
        $matricular->bindParam(':codDisciplina', $disciplina['codDisciplina']);
        $matricular->execute();

        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' href='../css/style.css'>
            <title>Document</title>
        </head>
        <body>
        <section class='cadastro-usuario alterar-dados'>
            <div class='identificacao-section'>
                <img src='assets/logotipo_logo.png' alt=''>
                <h1 class='title-section'>Matrícula realizada com sucesso!</h1>
            </div>
            <button class='button'><a href='matriculardisciplina.php'>Voltar</a></button>
        </section>
        </body>
        </html>";
       
    }
}
?>
