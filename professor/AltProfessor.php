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

   $idProfessor = $_POST['id'];

   ##sql para selecionar apens um aluno
   $sql = "SELECT * FROM professor where id= :idProfessor";
   
   # junta o sql a conexao do banco
   $retorno = $conexao->prepare($sql);

   ##diz o paramentro e o tipo  do paramentros
   $retorno->bindParam(':idProfessor',$idProfessor, PDO::PARAM_INT);

   #executa a estrutura no banco
   $retorno->execute();

  #transforma o retorno em array
   $array_retorno=$retorno->fetch();
   
   ##armazena retorno em variaveis
   $nomeProfessor = $array_retorno['nome'];
   $enderecoProfessor = $array_retorno['endereco'];
   $statusProfessor = $array_retorno['estatus'];
   $acessoProfessor = $array_retorno['siape'];
   $dtaNascimentoProfessor = $array_retorno['datanascimento'];


?>
<section class="cadastro-usuario alterar-dados">
        <div class="identificacao-section">
            <img src="assets/logotipo_logo.png" alt="">
            <h1 class="title-section">Alterar professor</h1>
        </div>
 <div class="fundo">
    <div class="background-btns">
  <form method="POST" action="crudprofessor.php">
  <div class="dados-usuario" id="alterar-dados">
  <div class="preenchimento-dados">
  <label for="nomeProfessor">Nome:</label>
    <input type="text" name="nomeProfessor" id="nomeProfessor" value="<?php echo htmlspecialchars($nomeProfessor); ?>"><br>
  </div>
    <div class="preenchimento-dados">
    <label for="telefoneProfessor">Telefone:</label>
    <input type="text" name="telefoneProfessor" id="telefoneProfessor" value=""<?php (!empty($telefone)) ? htmlspecialchars($telefone) : '';  ?>""><br>
    </div>
    <div class="preenchimento-dados">
    <label for="enderecoProfessor">Endereço:</label>
    <input type="text" name="enderecoProfessor" id="enderecoProfessor" value="<?php echo htmlspecialchars($enderecoProfessor); ?>"><br>
    </div>
    <div class="preenchimento-dados">
    <label for="statusProfessor">Status (1 - AT, 2 - INAT):</label>
    <input type="text" name="statusProfessor" id="statusProfessor" value="<?php echo htmlspecialchars($statusProfessor); ?>"><br>
    </div>
    <div class="preenchimento-dados">
    <label for="acessoProfessor">Acesso:</label>
    <input type="text" name="acessoProfessor" id="acessoProfessor" value="<?php echo htmlspecialchars($acessoProfessor); ?>"><br>
    </div>
    <div class="preenchimento-dados">
    <label for="emailProfessor">Email:</label>
    <input type="email" name="emailProfessor" id="emailProfessor" value="<?php (!empty($email)) ? htmlspecialchars($email) : '';  ?>"><br>
    </div>
    <div class="preenchimento-dados">
    <label for="senhaProfessor">Senha:</label>
    <input type="password" name="senhaProfessor" id="senhaProfessor" value="<?php (!empty($senhaAluno)) ? htmlspecialchars($senhaAluno) : '';  ?>"><br>
    </div>
    <div class="preenchimento-dados">
    <label for="dtaNascimentoProfessor">Data de Nascimento:</label>
    <input type="date" name="dtaNascimentoProfessor" id="dtaNascimentoProfessor" value="<?php echo htmlspecialchars($dtaNascimentoProfessor); ?>"><br>
    </div>
  </div>
    <input type="hidden" name="idProfessor" value="<?php echo htmlspecialchars($idProfessor); ?>">
    <input type="submit" name="update" value="Alterar" id="btn-alterar">
  </form>
  </div>
 </div>
</section>
</body>
</html>