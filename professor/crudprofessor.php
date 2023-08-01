<?php
##permite acesso as variaves dentro do aquivo conexao
require_once('../conexao.php');
   ##cadastrar
if(isset($_GET['cadastrar'])){
        ##dados recebidos pelo metodo GET
        $nomeProfessor = $_POST["nomeProfessor"];
        $telefoneProfessor = $_POST["telefoneProfessor"];
        $enderecoProfessor = $_POST["enderecoProfessor"];
        $emailProfessor = $_POST["emailProfessor"];
        $senhaProfessor = $_POST["senhaProfessor"];
        $acessoProfessor = $_POST["acessoProfessor"];
        $dtaNascimentoProfessor = $_POST["dtaNascimentoProfessor"];

        ##codigo SQL
        $sql = "INSERT INTO Professor(nomeProfessor,telefoneProfessor, enderecoProfessor, emailProfessor, dtaNascimentoProfessor, statusProfessor, senhaProfessor, acessoProfessor) 
                VALUES('$nomeProfessor','$telefoneProfessor','$enderecoProfessor', '$emailProfessor','$dtaNascimentoProfessor',true,'$senhaProfessor', '$acessoProfessor')";

        ##junta o codigo sql a conexao do banco
        $sqlcombanco = $conexao->prepare($sql);

        ##executa o sql no banco de dados
        if($sqlcombanco->execute())
            {
                echo " <strong>OK!</strong> o Professor
                $nomeProfessor foi Incluido com sucesso!!!"; 
                echo " <button class='button'><a href='cadprofessor.php'>Voltar</a></button>";
                echo " <button class='button'><a href='listaProfessor.php'>Listar professores</a></button>";
            }
        }

#######alterar
if (isset($_POST['update'])) {
    // Restante do código para receber os dados do formulário...
    $idProfessor = $_POST['idProfessor'];
        $nomeProfessor = $_POST['nomeProfessor'];
        $telefoneProfessor = $_POST['telefoneProfessor'];
        $enderecoProfessor = $_POST['enderecoProfessor'];
        $statusProfessor = $_POST['statusProfessor'];
        $acessoProfessor = $_POST['acessoProfessor'];
        $emailProfessor = $_POST['emailProfessor'];
        $senhaProfessor = $_POST['senhaProfessor'];
        $dtaNascimentoProfessor = $_POST['dtaNascimentoProfessor'];
    // Código SQL para atualização...
    $sql = "UPDATE  Professor SET nomeProfessor = :nomeProfessor, telefoneProfessor = :telefoneProfessor, enderecoProfessor = :enderecoProfessor, emailProfessor = :emailProfessor, dtaNascimentoProfessor = :dtaNascimentoProfessor, statusProfessor = :statusProfessor, senhaProfessor = :senhaProfessor, acessoProfessor = :acessoProfessor WHERE idProfessor = :idProfessor ";

    // Junta o código SQL à conexão do banco
    $stmt = $conexao->prepare($sql);

    // Define os parâmetros e seus tipos
    $stmt->bindParam(':idProfessor', $idProfessor, PDO::PARAM_INT);
    $stmt->bindParam(':nomeProfessor', $nomeProfessor, PDO::PARAM_STR);
    $stmt->bindParam(':telefoneProfessor', $telefoneProfessor, PDO::PARAM_STR);
    $stmt->bindParam(':enderecoProfessor', $enderecoProfessor, PDO::PARAM_STR);
    $stmt->bindParam(':emailProfessor', $emailProfessor, PDO::PARAM_STR);
    $stmt->bindParam(':dtaNascimentoProfessor', $dtaNascimentoProfessor, PDO::PARAM_STR);
    $stmt->bindParam(':statusProfessor', $statusProfessor, PDO::PARAM_STR);
    $stmt->bindParam(':senhaProfessor', $senhaProfessor, PDO::PARAM_STR);
    $stmt->bindParam(':acessoProfessor', $acessoProfessor, PDO::PARAM_STR);
    // Executa a consulta
    if ($stmt->execute()) {
        echo "<strong>OK!</strong> O Professor foi atualizado com sucesso!";
        echo " <button class='button'><a href='listaprofessor.php'>Voltar</a></button>";
    } else {
        echo "Erro ao atualizar o Professor.";
    }
}



#excluir
// Função para realizar a exclusão do professor
function excluirProfessor($conexao, $idProfessor) {
    try {
        $sql = "DELETE FROM `Professor` WHERE idProfessor = :idProfessor";
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idProfessor', $idProfessor, PDO::PARAM_INT);
        $stmt->execute();

        echo "<strong>OK!</strong> O Professor $idProfessor foi excluído!!!";
        echo " <button class='button'><a href='listaprofessor.php'>Voltar</a></button>";
    } catch (PDOException $e) {
        echo "Erro ao excluir o registro: " . $e->getMessage();
    }
}

// Supondo que você já tenha a conexão com o banco de dados $conexao e o id do professor que deseja excluir $idProfessor.

// Verificar se a exclusão foi solicitada e se o ID do professor foi fornecido
if (isset($_GET['excluir']) && isset($_GET['idProfessor'])) {
    $idProfessor = $_GET['idProfessor'];

    // Verificar se o usuário confirmou a exclusão
    if (isset($_POST['confirmar']) && $_POST['confirmar'] === '1') {
        excluirProfessor($conexao, $idProfessor);
    } else {
        // Caso o usuário ainda não tenha confirmado a exclusão, exibir o formulário de confirmação
        echo "Tem certeza que deseja excluir o Professor $idProfessor?";
        echo "<form action='crudprofessor.php?excluir=1&idProfessor=$idProfessor' method='post'>";
        echo "<input type='hidden' name='confirmar' value='1'>";
        echo "<button type='submit'>Confirmar</button>";
        echo "</form>";
        echo "<button><a href='listaprofessor.php'>Cancelar</a></button>";
    }
}




