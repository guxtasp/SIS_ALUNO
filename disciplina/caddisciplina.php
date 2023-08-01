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
  ?>
  <section class="cadastro-usuario">
    <div class="identificacao-section">
      <img src="assets/logotipo_logo.png" alt="">
      <h1 class="title-section">Cadastro de Disciplina</h1>
    </div>
    <hr>
    <form method="GET" action="cruddisciplina.php" class="form-cadastro" onsubmit="return validarFormulario()">

      <div class="dados-usuario">
        <div class="preenchimento-dados">
          <label for="nomeDisciplina">Nome:</label>
          <input type="text" name="nomeDisciplina">
        </div>

        <div class="preenchimento-dados">
          <label for="cargaHoraria">Carga Horária:</label>
          <input type="number" name="cargaHoraria">
        </div>



        <div class="preenchimento-dados">
          <label for="codProfessor">Professor:</label>
          <select name="codProfessor" class="acesso-professores">
            <option> Selecione o Professor</option>
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
                echo '<option value="' . $row["idProfessor"] . '">' . $row["nomeProfessor"] . '</option>';
              }
            } else {
              echo '<option value="">Nenhum Professor encontrado</option>';
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
            ?>
          </select>
        </div>

        <div class="btns-funcionais">
          <input type="submit" name="cadastrar" value="Cadastrar" id="cadastrar">
          <button class="button"><a href="acesso-disciplina.html">Voltar</a></button>
        </div>
    </form>

  </section>
  <script>
    function validarFormulario() {
      const nomeDisciplina = document.querySelector('[name="nomeDisciplina"]').value;
      const cargaHoraria = document.querySelector('[name="cargaHoraria"]').value;
      const codProfessor = document.querySelector('[name="codProfessor"]').value;

      if (nomeDisciplina.trim() === "") {
        alert("O nome da disciplina é obrigatório.");
        return false;
      }

      if (cargaHoraria <= 0) {
        alert("A carga horária deve ser um valor numérico maior que zero.");
        return false;
      }

      if (codProfessor === "" || codProfessor === "Selecione o Professor") {
        alert("Selecione um professor válido.");
        return false;
      }

      return true;
    }
  </script>

</body>

</html>