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

   $codDisciplina = $_POST['codDisciplina'];

   ##sql para selecionar apens um aluno
   $sql = "SELECT * FROM Disciplina where codDisciplina= :codDisciplina";
   
   # junta o sql a conexao do banco
   $retorno = $conexao->prepare($sql);

   ##diz o paramentro e o tipo  do paramentros
   $retorno->bindParam(':codDisciplina',$codDisciplina, PDO::PARAM_INT);

   #executa a estrutura no banco
   $retorno->execute();

  #transforma o retorno em array
   $array_retorno=$retorno->fetch();
   
   ##armazena retorno em variaveis
   $codDisciplina = $array_retorno['codDisciplina'];
   $nomeDisciplina = $array_retorno['nomeDisciplina'];
   $cargaHoraria = $array_retorno['cargaHoraria'];
   $Professor_idProfessor = $array_retorno['Professor_idProfessor'];


?>
 <div class="fundo">
    <div class="background-btns">
  <form method="POST" action="cruddisciplina.php">
  <label for="nomeDisciplina">Nome:</label>
    <input type="text" name="nomeDisciplina" id="nomeDisciplina" value="<?php echo htmlspecialchars($nomeDisciplina); ?>"><br>

    <label for="cargaHoraria">Carga Horária:</label>
    <input type="number" name="cargaHoraria" id="cargaHoraria" value="<?php echo htmlspecialchars($cargaHoraria); ?>"><br>

    <label for="codProfessor">Professor:</label>
    <select name="codProfessor" class="acesso-professores">
            <option value="<?php echo htmlspecialchars($Professor_idProfessor); ?>"></option>
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
    <input type="hidden" name="codDisciplina" value="<?php echo htmlspecialchars($codDisciplina); ?>">

    <input type="submit" name="update" value="Alterar">
    </div>
 </div>
</body>
</html>