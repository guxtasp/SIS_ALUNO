<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>

<?php
    require_once('../conexao.php');

   $idAluno = $_POST['idAluno'];

   ##sql para selecionar apens um aluno
   $sql = "SELECT * FROM aluno where id= :idAluno";
   
   # junta o sql a conexao do banco
   $retorno = $conexao->prepare($sql);

   ##diz o paramentro e o tipo  do paramentros
   $retorno->bindParam(':idAluno',$idAluno, PDO::PARAM_INT);

   #executa a estrutura no banco
   $retorno->execute();

  #transforma o retorno em array
   $array_retorno=$retorno->fetch();
   
   ##armazena retorno em variaveis
   $nomeAluno = $array_retorno['nome'];
   $enderecoAluno = $array_retorno['endereco'];
   $estatusAluno = $array_retorno['estatus'];
   $matriculaAluno = $array_retorno['matricula'];
   $dtaNascimentoAluno = $array_retorno['datanascimento'];


?>
<section class="cadastro-usuario alterar-dados">
        <div class="identificacao-section">
            <img src="assets/logotipo_logo.png" alt="">
            <h1 class="title-section">Alterar Aluno</h1>
        </div>
 <div class="fundo">
    <div class="background-btns">
    <form method="POST" action="crudaluno.php">
    <div class="dados-usuario" id="alterar-dados">
  <div class="preenchimento-dados">
  <label for="nomeAluno">Nome:</label>
    <input type="text" name="nomeAluno" id="nomeAluno" value="<?php echo htmlspecialchars($nomeAluno); ?>"><br>
  </div>
    <div class="preenchimento-dados">
    <label for="telefoneAluno">Telefone:</label>
    <input type="text" name="telefoneAluno" id="telefoneAluno" value="<?php (!empty($telefoneAluno)) ? htmlspecialchars($telefoneAluno) : '';  ?>"><br>
    </div>
    <div class="preenchimento-dados">
    <label for="enderecoAluno">Endereço:</label>
    <input type="text" name="enderecoAluno" id="enderecoAluno" value="<?php echo htmlspecialchars($enderecoAluno); ?>"><br>
    </div>
    <div class="preenchimento-dados">
    <label for="statusAluno">Status (1 - AT, 2 - INAT):</label>
    <input type="text" name="statusAluno" id="statusAluno" value="<?php (!empty($statusAluno)) ? htmlspecialchars($statusAluno) : '';  ?>"><br>
    </div>
    <div class="preenchimento-dados">
    <label for="matriculaAluno">Acesso:</label>
    <input type="text" name="matriculaAluno" id="matriculaAluno" value="<?php echo htmlspecialchars($matriculaAluno); ?>"><br>
    </div>
    <div class="preenchimento-dados">
    <label for="emailAluno">Email:</label>
    <input type="email" name="emailAluno" id="emailAluno" value="<?php (!empty($emailAluno)) ? htmlspecialchars($emailAluno) : '';  ?>"><br>
    </div>
    <div class="preenchimento-dados">
    <label for="senhaAluno">Senha:</label>
    <input type="password" name="senhaAluno" id="senhaAluno" value="<?php (!empty($senhaAluno)) ? htmlspecialchars($senhaAluno) : ''; ?>"><br>
    </div>
    <div class="preenchimento-dados">
    <label for="dtaNascimentoAluno">Data de Nascimento:</label>
    <input type="date" name="dtaNascimentoAluno" id="dtaNascimentoAluno" value="<?php echo htmlspecialchars($dataNascimentoAluno); ?>"><br>
    </div>
  </div>
    <input type="hidden" name="idAluno" value="<?php echo htmlspecialchars($idAluno); ?>">

    <input type="submit" name="update" value="Alterar" id="btn-alterar">
    </div>
 </div>
</section>
</body>
</html>

