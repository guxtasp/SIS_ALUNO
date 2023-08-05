<?php
##permite acesso as variaves dentro do aquivo conexao
require_once('../conexao.php');

##cadastrar
if (isset($_POST['cadastrar'])) {
    ##dados recebidos pelo metodo GET
    $nomeProfessor = $_POST["nomeProfessor"];
    $telefoneProfessor = $_POST["telefoneProfessor"];
    $enderecoProfessor = $_POST["enderecoProfessor"];
    $emailProfessor = $_POST["emailProfessor"];
    $senhaProfessor = $_POST["senhaProfessor"];
    $acessoProfessor = $_POST["acessoProfessor"];
    $datanascimento = $_POST["datanascimentoProfessor"];

    ##codigo SQL
    $sql = "INSERT INTO professor(nome, endereco, datanascimento, estatus, siape) 
                VALUES('$nomeProfessor','$enderecoProfessor','$datanascimento',AT', '$acessoProfessor')";

    ##junta o codigo sql a conexao do banco
    $sqlcombanco = $conexao->prepare($sql);

    ##executa o sql no banco de dados
    if ($sqlcombanco->execute()) {
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
                        <h1 class='title-section'>o Professor
                        $nomeProfessor foi Incluido com sucesso!!!</h1>
                    </div>
                     <button class='button'><a href='cadprofessor.php'>Voltar</a></button>
                 <button class='button'><a href='listaProfessor.php'>Listar professores</a></button>
                </section>
                </body>
                </html>";
    }
}

#######alterar
if (isset($_POST['update'])) {
    // Restante do código para receber os dados do formulário...

    $idProfessor = $_POST['idProfessor'];
    $nomeProfessor = $_POST['nomeProfessor'];
    $enderecoProfessor = $_POST['enderecoProfessor'];
    $statusProfessor = $_POST['statusProfessor'];
    $acessoProfessor = $_POST['acessoProfessor'];
    $dtaNascimentoProfessor = $_POST['dtaNascimentoProfessor'];
    // Código SQL para atualização...
    $sql = "UPDATE  professor SET nome = :nomeProfessor, endereco = :enderecoProfessor, datanascimento = :dtaNascimentoProfessor, estatus = :statusProfessor, siape = :acessoProfessor WHERE id = :idProfessor ";

    // Junta o código SQL à conexão do banco
    $stmt = $conexao->prepare($sql);

    // Define os parâmetros e seus tipos
    $stmt->bindParam(':idProfessor', $idProfessor, PDO::PARAM_INT);
    $stmt->bindParam(':nomeProfessor', $nomeProfessor, PDO::PARAM_STR);
    $stmt->bindParam(':enderecoProfessor', $enderecoProfessor, PDO::PARAM_STR);
    $stmt->bindParam(':dtaNascimentoProfessor', $dtaNascimentoProfessor, PDO::PARAM_STR);
    $stmt->bindParam(':statusProfessor', $statusProfessor, PDO::PARAM_STR);
    $stmt->bindParam(':acessoProfessor', $acessoProfessor, PDO::PARAM_STR);
    // Executa a consulta
    if ($stmt->execute()) {
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
                      <h1 class='title-section'>Alterado com sucesso!</h1>
                  </div>
                  <button class='button'><a href='listaprofessor.php'>Voltar</a></button>
              </section>
              </body>
              </html>";
    } else {
        echo "Erro ao atualizar o Professor.";
    }
}



#excluir
// Função para realizar a exclusão do professor
function excluirProfessor($conexao, $idProfessor)
{
    try {
        $sql = "DELETE FROM `professor` WHERE id = :idProfessor";
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idProfessor', $idProfessor, PDO::PARAM_INT);
        $stmt->execute();
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
                <h1 class='title-section'>O Professor $idProfessor foi excluído!!!</h1>
            </div>
            <button class='button'><a href='listaprofessor.php'>Voltar</a></button>
        </section>
        </body>
        </html>";
    } catch (PDOException $e) {
        echo "Erro ao excluir o registro: " . $e->getMessage();
    }
}

// Verificar se a exclusão foi solicitada e se o ID do professor foi fornecido
if (isset($_GET['excluir']) && isset($_GET['idProfessor'])) {
    $idProfessor = $_GET['idProfessor'];

    // Verificar se o usuário confirmou a exclusão
    if (isset($_POST['confirmar']) && $_POST['confirmar'] === '1') {
        excluirProfessor($conexao, $idProfessor);
    } else {
        // Caso o usuário ainda não tenha confirmado a exclusão, exibir o formulário de confirmação
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "    <meta charset='UTF-8'>";
        echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "    <title>Excluir Professor</title>";
        echo "    <link rel='stylesheet' href='../css/style.css'>";
        echo "<style>a, .editar{
            text-decoration: none;
            color: #ffff;
        }</style>";
        echo "</head>";
        echo "<body>";
        echo "<section class='cadastro-usuario alterar-dados'>";
        echo "    <div class='identificacao-section'>";
        echo "        <img src='assets/logotipo_logo.png' alt=''>";
        echo "        <h1 class='title-section'>Excluir professor</h1>";
        echo "    </div>";
        echo "    <div>";
        echo "        Tem certeza que deseja excluir o Professor $idProfessor?";
        echo "        <form action='crudprofessor.php?excluir=1&idProfessor=$idProfessor' method='post'>";
        echo "            <input type='hidden' name='confirmar' value='1'>";
        echo "            <button class='btn-crud' type='submit'>Confirmar</button>";
        echo "        </form>";
        echo "        <button class='btn-crud delete'><a class='editar' href='listaprofessor.php'>Cancelar</a></button>";
        echo "    </div>";
        echo "</section>";
        echo "<body>";
    }
}
