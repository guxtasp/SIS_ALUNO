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

        echo "Matrícula realizada com sucesso!";
        echo "<button class='button button3'><a href='acesso-aluno.html'>Voltar</a></button>";
    }
}
?>
