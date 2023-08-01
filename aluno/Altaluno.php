<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<?php
    require_once('../conexao.php');

   $idAluno = $_POST['idAluno'];

   ##sql para selecionar apens um aluno
   $sql = "SELECT * FROM Aluno where idAluno= :idAluno";
   
   # junta o sql a conexao do banco
   $retorno = $conexao->prepare($sql);

   ##diz o paramentro e o tipo  do paramentros
   $retorno->bindParam(':idAluno',$idAluno, PDO::PARAM_INT);

   #executa a estrutura no banco
   $retorno->execute();

  #transforma o retorno em array
   $array_retorno=$retorno->fetch();
   
   ##armazena retorno em variaveis
   $nomeAluno = $array_retorno['nomeAluno'];
   $telefoneAluno = $array_retorno['telefoneAluno'];
   $enderecoAluno = $array_retorno['enderecoAluno'];
   $statusAluno = $array_retorno['statusAluno'];
   $matriculaAluno = $array_retorno['matriculaAluno'];
   $emailAluno = $array_retorno['emailAluno'];
   $senhaAluno = $array_retorno['senhaAluno'];
   $dtaNascimentoAluno = $array_retorno['dtaNascimentoAluno'];


?>
 <div class="fundo">
    <div class="background-btns">
  <form method="POST" action="crudAluno.php">
  <label for="nomeAluno">Nome:</label>
    <input type="text" name="nomeAluno" id="nomeAluno" value="<?php echo htmlspecialchars($nomeAluno); ?>"><br>

    <label for="telefoneAluno">Telefone:</label>
    <input type="text" name="telefoneAluno" id="telefoneAluno" value="<?php echo htmlspecialchars($telefoneAluno); ?>"><br>

    <label for="enderecoAluno">Endereço:</label>
    <input type="text" name="enderecoAluno" id="enderecoAluno" value="<?php echo htmlspecialchars($enderecoAluno); ?>"><br>

    <label for="statusAluno">Status (MT - MATRICULADO, MI - MATRICULA INATIVA):</label>
    <input type="text" name="statusAluno" id="statusAluno" value="<?php echo htmlspecialchars($statusAluno); ?>"><br>

    <label for="MatriculaAluno">Matricula:</label>
    <input type="text" name="matriculaAluno" id="matriculaAluno" value="<?php echo htmlspecialchars($matriculaAluno); ?>"><br>

    <label for="emailAluno">Email:</label>
    <input type="email" name="emailAluno" id="emailAluno" value="<?php echo htmlspecialchars($emailAluno); ?>"><br>

    <label for="senhaAluno">Senha:</label>
    <input type="password" name="senhaAluno" id="senhaAluno" value="<?php echo htmlspecialchars($senhaAluno); ?>"><br>

    <label for="dtaNascimentoAluno">Data de Nascimento:</label>
    <input type="date" name="dtaNascimentoAluno" id="dtaNascimentoAluno" value="<?php echo htmlspecialchars($dtaNascimentoAluno); ?>"><br>

    <input type="hidden" name="idAluno" value="<?php echo htmlspecialchars($idAluno); ?>">

    <input type="submit" name="update" value="Alterar">
    </div>
 </div>
</body>
</html>