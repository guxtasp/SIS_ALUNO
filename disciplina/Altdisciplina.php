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

  $codDisciplina = $_POST['codDisciplina'];

  ##sql para selecionar apens um aluno
  $sql = "SELECT * FROM disciplina where id= :codDisciplina";

  # junta o sql a conexao do banco
  $retorno = $conexao->prepare($sql);

  ##diz o paramentro e o tipo  do paramentros
  $retorno->bindParam(':codDisciplina', $codDisciplina, PDO::PARAM_INT);

  #executa a estrutura no banco
  $retorno->execute();

  #transforma o retorno em array
  $array_retorno = $retorno->fetch();

  ##armazena retorno em variaveis
  $codDisciplina = $array_retorno['id'];
  $nomeDisciplina = $array_retorno['nomedisciplina'];
  $cargaHoraria = $array_retorno['ch'];
  $Professor_idProfessor = $array_retorno['idprofessor'];


  ?>
  <section class="cadastro-usuario alterar-dados">
    <div class="identificacao-section">
      <img src="assets/logotipo_logo.png" alt="">
      <h1 class="title-section">Alterar disciplina</h1>
    </div>
    <div class="fundo">
      <div class="background-btns">
        <form method="POST" action="cruddisciplina.php">
          <div class="dados-usuario" id="alterar-dados">
            <div class="preenchimento-dados">
              <label for="nomeDisciplina">Nome:</label>
              <input type="text" name="nomeDisciplina" id="nomeDisciplina" value="<?php echo htmlspecialchars($nomeDisciplina); ?>"><br>
            </div>
            <div class="preenchimento-dados">
              <label for="cargaHoraria">Carga Horária:</label>
              <input type="number" name="cargaHoraria" id="cargaHoraria" value="<?php echo htmlspecialchars($cargaHoraria); ?>"><br>
            </div>
            <div class="preenchimento-dados">
              <label for="codProfessor">Professor:</label>
              <select name="codProfessor" class="acesso-professores">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "Gustavo1@";
                $dbname = "SIS_ALUNO";

                // Conexão com o banco de dados
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verifica se a conexão foi bem-sucedida
                if ($conn->connect_error) {
                  die("Conexão falhou: " . $conn->connect_error);
                }

                /// Query SQL para buscar os nomes e códigos dos professores no banco de dados
                $sql = "SELECT idProfessor, nomeProfessor FROM Professor";

                // Executa a query e obtém o resultado
                $result = $conn->query($sql);

                // Preenche as opções do select com os nomes dos professores
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    // Check if the current option is the one selected
                    $selected = ($row["idProfessor"] == $Professor_idProfessor) ? 'selected' : '';
                    echo '<option value="' . $row["idProfessor"] . '" ' . $selected . '>' . $row["nomeProfessor"] . '</option>';
                  }
                } else {
                  echo '<option value="">Nenhum Professor encontrado</option>';
                }

                // Fecha a conexão com o banco de dados
                $conn->close();
                ?>
              </select>
            </div>
            <input type="hidden" name="codDisciplina" value="<?php echo htmlspecialchars($codDisciplina); ?>">
            <input type="submit" name="update" value="Alterar" id="btn-alterar">
        </form>

      </div>
  </section>
</body>

</html>