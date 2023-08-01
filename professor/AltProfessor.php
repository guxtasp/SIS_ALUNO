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

   $idProfessor = $_POST['idProfessor'];

   ##sql para selecionar apens um aluno
   $sql = "SELECT * FROM Professor where idProfessor= :idProfessor";
   
   # junta o sql a conexao do banco
   $retorno = $conexao->prepare($sql);

   ##diz o paramentro e o tipo  do paramentros
   $retorno->bindParam(':idProfessor',$idProfessor, PDO::PARAM_INT);

   #executa a estrutura no banco
   $retorno->execute();

  #transforma o retorno em array
   $array_retorno=$retorno->fetch();
   
   ##armazena retorno em variaveis
   $nomeProfessor = $array_retorno['nomeProfessor'];
   $telefoneProfessor = $array_retorno['telefoneProfessor'];
   $enderecoProfessor = $array_retorno['enderecoProfessor'];
   $statusProfessor = $array_retorno['statusProfessor'];
   $acessoProfessor = $array_retorno['acessoProfessor'];
   $emailProfessor = $array_retorno['emailProfessor'];
   $senhaProfessor = $array_retorno['senhaProfessor'];
   $dtaNascimentoProfessor = $array_retorno['dtaNascimentoProfessor'];


?>
 <div class="fundo">
    <div class="background-btns">
  <form method="POST" action="crudprofessor.php">
  <label for="nomeProfessor">Nome:</label>
    <input type="text" name="nomeProfessor" id="nomeProfessor" value="<?php echo htmlspecialchars($nomeProfessor); ?>"><br>

    <label for="telefoneProfessor">Telefone:</label>
    <input type="text" name="telefoneProfessor" id="telefoneProfessor" value="<?php echo htmlspecialchars($telefoneProfessor); ?>"><br>

    <label for="enderecoProfessor">Endereço:</label>
    <input type="text" name="enderecoProfessor" id="enderecoProfessor" value="<?php echo htmlspecialchars($enderecoProfessor); ?>"><br>

    <label for="statusProfessor">Status (1 - AT, 2 - INAT):</label>
    <input type="text" name="statusProfessor" id="statusProfessor" value="<?php echo htmlspecialchars($statusProfessor); ?>"><br>

    <label for="acessoProfessor">Acesso:</label>
    <input type="text" name="acessoProfessor" id="acessoProfessor" value="<?php echo htmlspecialchars($acessoProfessor); ?>"><br>

    <label for="emailProfessor">Email:</label>
    <input type="email" name="emailProfessor" id="emailProfessor" value="<?php echo htmlspecialchars($emailProfessor); ?>"><br>

    <label for="senhaProfessor">Senha:</label>
    <input type="password" name="senhaProfessor" id="senhaProfessor" value="<?php echo htmlspecialchars($senhaProfessor); ?>"><br>

    <label for="dtaNascimentoProfessor">Data de Nascimento:</label>
    <input type="date" name="dtaNascimentoProfessor" id="dtaNascimentoProfessor" value="<?php echo htmlspecialchars($dtaNascimentoProfessor); ?>"><br>

    <input type="hidden" name="idProfessor" value="<?php echo htmlspecialchars($idProfessor); ?>">

    <input type="submit" name="update" value="Alterar">
    </div>
 </div>
</body>
</html>