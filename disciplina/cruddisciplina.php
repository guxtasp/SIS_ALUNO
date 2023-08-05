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
        $sql = "INSERT INTO disciplina(nomedisciplina,ch,idprofessor) 
                VALUES('$nomeDisciplina','$cargaHoraria','$Professor_idProfessor')";

        ##junta o codigo sql a conexao do banco
        $sqlcombanco = $conexao->prepare($sql);

        ##executa o sql no banco de dados
        if($sqlcombanco->execute())
            {
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
                <h1 class='title-section'>A disciplina
                $nomeDisciplina foi Incluido com sucesso!!!</h1>
            </div>
            <button class='button'><a href='listadisciplina.php'>Voltar</a></button>
            
        </section>
        </body>
        </html>";
            }
        }

#######alterar
if (isset($_POST['update'])) {
    // Restante do código para receber os dados do formulário...
        $codDisciplina = $_POST['codDisciplina'];
        $nomeDisciplina = $_POST['nomeDisciplina'];
        $cargaHoraria = $_POST['cargaHoraria'];
        $Professor_idProfessor = $_POST['codProfessor'];

    // Código SQL para atualização...
    $sql = "UPDATE  disciplina SET nomedisciplina = :nomeDisciplina, ch = :cargaHoraria, idprofessor = :Professor_idProfessor WHERE id = :codDisciplina ";

    // Junta o código SQL à conexão do banco
    $stmt = $conexao->prepare($sql);

    // Define os parâmetros e seus tipos
    $stmt->bindParam(':codDisciplina', $codDisciplina, PDO::PARAM_INT);
    $stmt->bindParam(':nomeDisciplina', $nomeDisciplina, PDO::PARAM_STR);
    $stmt->bindParam(':cargaHoraria', $cargaHoraria, PDO::PARAM_INT);
    $stmt->bindParam(':Professor_idProfessor', $Professor_idProfessor, PDO::PARAM_INT);
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
                      <img src='../assets/logotipo_logo.png' alt=''>
                      <h1 class='title-section'>Alterado com sucesso!</h1>
                  </div>
                  <button class='button'><a href='listadisciplina.php'>Voltar</a></button>
              </section>
              </body>
              </html>";
    } else {
        echo "Erro ao atualizar o aluno.";
    }
}



#excluir
// Função para realizar a exclusão do professor
function excluirDisciplina($conexao, $codDisciplina) {
    try {
        $sql = "DELETE FROM `disciplina` WHERE id = :codDisciplina";
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':codDisciplina', $codDisciplina, PDO::PARAM_INT);
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
                <img src='../assets/logotipo_logo.png' alt=''>
                <h1 class='title-section'>A disciplina $codDisciplina foi excluída!!!</h1>
            </div>
            <button class='button'><a href='listadisciplina.php'>Voltar</a></button>
        </section>
        </body>
        </html>";
    } catch (PDOException $e) {
        echo "Erro ao excluir o registro: " . $e->getMessage();
    }
}

// Verificar se a exclusão foi solicitada e se o cod do disciplina foi forneccodo
if (isset($_GET['excluir']) && isset($_GET['codDisciplina'])) {
    $codDisciplina = $_GET['codDisciplina'];

    // Verificar se o usuário confirmou a exclusão
    if (isset($_POST['confirmar']) && $_POST['confirmar'] === '1') {
        excluirDisciplina($conexao, $codDisciplina);
    } else {
        // Caso o usuário ainda não tenha confirmado a exclusão, exibir o formulário de confirmação
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "    <meta charset='UTF-8'>";
        echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "    <title>Excluir Disciplina</title>";
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
        echo "        <h1 class='title-section'>Excluir disciplina</h1>";
        echo "    </div>";
        echo "    <div>";
        echo "        Tem certeza que deseja excluir a disciplina $codDisciplina?";
        echo "        <form action='cruddisciplina.php?excluir=1&codDisciplina=$codDisciplina' method='post'>";
        echo "            <input type='hidden' name='confirmar' value='1'>";
        echo "            <button class='btn-crud' type='submit'>Confirmar</button>";
        echo "        </form>";
        echo "        <button class='btn-crud delete'><a class='editar' href='listadisciplina.php'>Cancelar</a></button>";
        echo "    </div>";
        echo "</section>";
        echo "<body>";
    }
}




