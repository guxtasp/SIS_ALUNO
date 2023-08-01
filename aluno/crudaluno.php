<?php
##permite matricula as variaves dentro do aquivo conexao
require_once('../conexao.php');
   ##cadastrar
if(isset($_GET['cadastrar'])){
        ##dados recebidos pelo metodo GET
        $nomeAluno = $_GET["nomeAluno"];
        $telefoneAluno = $_GET["telefoneAluno"];
        $enderecoAluno = $_GET["enderecoAluno"];
        $emailAluno = $_GET["emailAluno"];
        $senhaAluno = $_GET["senhaAluno"];
        $matriculaAluno = $_GET["matriculaAluno"];
        $dtaNascimentoAluno = $_GET["dtaNascimentoAluno"];

        ##codigo SQL
        $sql = "INSERT INTO Aluno(nomeAluno,telefoneAluno, enderecoAluno, emailAluno, dtaNascimentoAluno, statusAluno, senhaAluno,matriculaAluno) 
                VALUES('$nomeAluno','$telefoneAluno','$enderecoAluno', '$emailAluno','$dtaNascimentoAluno','MT','$senhaAluno', '$matriculaAluno')";

        ##junta o codigo sql a conexao do banco
        $sqlcombanco = $conexao->prepare($sql);

        ##executa o sql no banco de dados
        if($sqlcombanco->execute())
            {
                echo " <strong>OK!</strong> o Aluno
                $nomeAluno foi Incluido com sucesso!!!"; 
                echo " <button class='button'><a href='cadaluno.php'>Voltar</a></button>";
                echo " <button class='button'><a href='listaaluno.php'>Listar alunos</a></button>";
            }
        }

#######alterar
if (isset($_POST['update'])) {
    // Restante do código para receber os dados do formulário...
        $idAluno = $_POST['idAluno'];
        $nomeAluno = $_POST['nomeAluno'];
        $telefoneAluno = $_POST['telefoneAluno'];
        $enderecoAluno = $_POST['enderecoAluno'];
        $statusAluno = $_POST['statusAluno'];
        $matriculaAluno = $_POST['matriculaAluno'];
        $emailAluno = $_POST['emailAluno'];
        $senhaAluno = $_POST['senhaAluno'];
        $dtaNascimentoAluno = $_POST['dtaNascimentoAluno'];
    // Código SQL para atualização...
    $sql = "UPDATE  Aluno SET nomeAluno = :nomeAluno, telefoneAluno = :telefoneAluno, enderecoAluno = :enderecoAluno, emailAluno = :emailAluno, dtaNascimentoAluno = :dtaNascimentoAluno, statusAluno = :statusAluno, senhaAluno = :senhaAluno, matriculaAluno = :matriculaAluno WHERE idAluno = :idAluno ";

    // Junta o código SQL à conexão do banco
    $stmt = $conexao->prepare($sql);

    // Define os parâmetros e seus tipos
    $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
    $stmt->bindParam(':nomeAluno', $nomeAluno, PDO::PARAM_STR);
    $stmt->bindParam(':telefoneAluno', $telefoneAluno, PDO::PARAM_STR);
    $stmt->bindParam(':enderecoAluno', $enderecoAluno, PDO::PARAM_STR);
    $stmt->bindParam(':emailAluno', $emailAluno, PDO::PARAM_STR);
    $stmt->bindParam(':dtaNascimentoAluno', $dtaNascimentoAluno, PDO::PARAM_STR);
    $stmt->bindParam(':statusAluno', $statusAluno, PDO::PARAM_STR);
    $stmt->bindParam(':senhaAluno', $senhaAluno, PDO::PARAM_STR);
    $stmt->bindParam(':matriculaAluno', $matriculaAluno, PDO::PARAM_STR);
    // Executa a consulta
    if ($stmt->execute()) {
        echo "<strong>OK!</strong> O Aluno foi atualizado com sucesso!";
        echo " <button class='button'><a href='listaAluno.php'>Voltar</a></button>";
    } else {
        echo "Erro ao atualizar o Aluno.";
    }
}



#excluir
// Função para realizar a exclusão do Aluno
function excluirAluno($conexao, $idAluno) {
    try {
        $sql = "DELETE FROM `Aluno` WHERE idAluno = :idAluno";
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
        $stmt->execute();

        echo "<strong>OK!</strong> O Aluno $idAluno foi excluído!!!";
        echo " <button class='button'><a href='listaAluno.php'>Voltar</a></button>";
    } catch (PDOException $e) {
        echo "Erro ao excluir o registro: " . $e->getMessage();
    }
}

// Supondo que você já tenha a conexão com o banco de dados $conexao e o id do Aluno que deseja excluir $idAluno.

// Verificar se a exclusão foi solicitada e se o ID do Aluno foi fornecido
if (isset($_GET['excluir']) && isset($_GET['idAluno'])) {
    $idAluno = $_GET['idAluno'];

    // Verificar se o usuário confirmou a exclusão
    if (isset($_POST['confirmar']) && $_POST['confirmar'] === '1') {
        excluirAluno($conexao, $idAluno);
    } else {
        // Caso o usuário ainda não tenha confirmado a exclusão, exibir o formulário de confirmação
        echo "Tem certeza que deseja excluir o Aluno $idAluno?";
        echo "<form action='crudAluno.php?excluir=1&idAluno=$idAluno' method='post'>";
        echo "<input type='hidden' name='confirmar' value='1'>";
        echo "<button type='submit'>Confirmar</button>";
        echo "</form>";
        echo "<button><a href='listaAluno.php'>Cancelar</a></button>";
    }
}




