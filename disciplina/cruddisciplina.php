<?php
##permite acesso as variaves dentro do aquivo conexao
require_once('../conexao.php');
   ##cadastrar
if(isset($_GET['cadastrar'])){
        ##dados recebidos pelo metodo GET
        $nomeDisciplina = $_GET["nomeDisciplina"];
        $cargaHoraria = $_GET["cargaHoraria"];
        $Professor_idProfessor = $_GET["codProfessor"];

        ##codigo SQL
        $sql = "INSERT INTO Disciplina(nomeDisciplina,cargaHoraria, Professor_idProfessor) 
                VALUES('$nomeDisciplina','$cargaHoraria','$Professor_idProfessor')";

        ##junta o codigo sql a conexao do banco
        $sqlcombanco = $conexao->prepare($sql);

        ##executa o sql no banco de dados
        if($sqlcombanco->execute())
            {
                echo " <strong>OK!</strong> o Professor
                $nomeDisciplina foi Incluido com sucesso!!!"; 
                echo " <button class='button'><a href='caddisciplina.php'>Voltar</a></button>";
                echo " <button class='button'><a href='listadisciplina.php'>Listar disciplinas</a></button>";
            }
        }

#######alterar
if (isset($_POST['update'])) {
    // Restante do código para receber os dados do formulário...
        $codDisciplina = $_POST['codDisciplina'];
        $nomeDisciplina = $_POST['nomeDisciplina'];
        $cargaHoraria = $_POST['cargaHoraria'];
        $Professor_idProfessor = $_POST['codProfessor'];
        echo $codDisciplina;
        echo $Professor_idProfessor;
    // Código SQL para atualização...
    $sql = "UPDATE  Disciplina SET nomeDisciplina = :nomeDisciplina, cargaHoraria = :cargaHoraria, Professor_idProfessor = :Professor_idProfessor WHERE codDisciplina = :codDisciplina ";

    // Junta o código SQL à conexão do banco
    $stmt = $conexao->prepare($sql);

    // Define os parâmetros e seus tipos
    $stmt->bindParam(':codDisciplina', $codDisciplina, PDO::PARAM_INT);
    $stmt->bindParam(':nomeDisciplina', $nomeDisciplina, PDO::PARAM_STR);
    $stmt->bindParam(':cargaHoraria', $cargaHoraria, PDO::PARAM_INT);
    $stmt->bindParam(':Professor_idProfessor', $Professor_idProfessor, PDO::PARAM_INT);
    // Executa a consulta
    if ($stmt->execute()) {
        echo "<strong>OK!</strong> O Professor foi atualizado com sucesso!";
        echo " <button class='button'><a href='listadisciplina.php'>Voltar</a></button>";
    } else {
        echo "Erro ao atualizar o Professor.";
    }
}



#excluir
// Função para realizar a exclusão do professor
function excluirDisciplina($conexao, $codDisciplina) {
    try {
        $sql = "DELETE FROM `Disciplina` WHERE codDisciplina = :codDisciplina";
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':codDisciplina', $codDisciplina, PDO::PARAM_INT);
        $stmt->execute();

        echo "<strong>OK!</strong> O Disciplina $codDisciplina foi excluído!!!";
        echo " <button class='button'><a href='listadisciplina.php'>Voltar</a></button>";
    } catch (PDOException $e) {
        echo "Erro ao excluir o registro: " . $e->getMessage();
    }
}

// Supondo que você já tenha a conexão com o banco de dados $conexao e o cod do disciplina que deseja excluir $coddisciplina.

// Verificar se a exclusão foi solicitada e se o cod do disciplina foi forneccodo
if (isset($_GET['excluir']) && isset($_GET['codDisciplina'])) {
    $codDisciplina = $_GET['codDisciplina'];

    // Verificar se o usuário confirmou a exclusão
    if (isset($_POST['confirmar']) && $_POST['confirmar'] === '1') {
        excluirDisciplina($conexao, $codDisciplina);
    } else {
        // Caso o usuário ainda não tenha confirmado a exclusão, exibir o formulário de confirmação
        echo "Tem certeza que deseja excluir o Disciplina $codDisciplina?";
        echo "<form action='cruddisciplina.php?excluir=1&codDisciplina=$codDisciplina' method='post'>";
        echo "<input type='hidden' name='confirmar' value='1'>";
        echo "<button type='submit'>Confirmar</button>";
        echo "</form>";
        echo "<button><a href='listadisciplina.php'>Cancelar</a></button>";
    }
}




