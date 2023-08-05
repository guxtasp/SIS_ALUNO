
<?php
##permite acesso as variaves dentro do aquivo conexao
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
        $sql = "INSERT INTO aluno(nome, endereco, datanascimento, estatus, matricula) 
                VALUES('$nomeAluno','$enderecoAluno','$dtaNascimentoAluno', 1 , '$matriculaAluno')";

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
                        <h1 class='title-section'>o Aluno
                        $nomeAluno foi Incluido com sucesso!!!</h1>
                    </div>
                     <button class='button'><a href='cadaluno.php'>Voltar</a></button>
                 <button class='button'><a href='listaaluno.php'>Listar professores</a></button>
                </section>
                </body>
                </html>";
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
    $sql = "UPDATE  aluno SET nome = :nomeAluno, endereco = :enderecoAluno, email = :emailAluno, datanascimento = :dtaNascimentoAluno, estatus = :statusAluno, matricula = :matriculaAluno WHERE id = :idAluno ";

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
                  <button class='button'><a href='listaaluno.php'>Voltar</a></button>
              </section>
              </body>
              </html>";
    } else {
        echo "Erro ao atualizar o Aluno.";
    }
}



#excluir
// Função para realizar a exclusão do aluno
function excluirAluno($conexao, $idAluno) {
    try {
        $sql = "DELETE FROM `aluno` WHERE id = :idAluno";
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
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
                <h1 class='title-section'>O Aluno $idAluno foi excluído!!!</h1>
            </div>
            <button class='button'><a href='listaaluno.php'>Voltar</a></button>
        </section>
        </body>
        </html>";
    } catch (PDOException $e) {
        echo "Erro ao excluir o registro: " . $e->getMessage();
    }
}

// Verificar se a exclusão foi solicitada e se o ID do aluno foi fornecido
if (isset($_GET['excluir']) && isset($_GET['idAluno'])) {
    $idAluno = $_GET['idAluno'];

    // Verificar se o usuário confirmou a exclusão
    if (isset($_POST['confirmar']) && $_POST['confirmar'] === '1') {
        excluirAluno($conexao, $idAluno);
    } else {
        // Caso o usuário ainda não tenha confirmado a exclusão, exibir o formulário de confirmação
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "    <meta charset='UTF-8'>";
        echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "    <title>Excluir Aluno</title>";
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
        echo "        <h1 class='title-section'>Excluir aluno</h1>";
        echo "    </div>";
        echo "    <div>";
        echo "        Tem certeza que deseja excluir o Aluno $idAluno?";
        echo "        <form action='crudaluno.php?excluir=1&idAluno=$idAluno' method='post'>";
        echo "            <input type='hidden' name='confirmar' value='1'>";
        echo "            <button class='btn-crud' type='submit'>Confirmar</button>";
        echo "        </form>";
        echo "        <button class='btn-crud delete'><a class='editar' href='listaaluno.php'>Cancelar</a></button>";
        echo "    </div>";
        echo "</section>";
        echo "<body>";
    }
}


