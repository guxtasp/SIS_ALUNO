
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>

<body>
<?php

require_once('../conexao.php');

$retorno = $conexao->prepare('SELECT * FROM professor');
$retorno->execute();

function imprimirStatus($valor) {
    // Verifica se o valor é igual a 1 ou true
    if ($valor === 1 || $valor === 'true' || $valor === 'AT') {
    return "ATIVO";
    } else {
    return "INATIVO";
    }
   }

?>
    <section class="direcionador-paginas" id="lista-usuario">
        <div class="identificacao-section">
            <img src="assets/logotipo_logo.png" alt="">
            <h1 class="title-section">Lista de Docentes</h1>
        </div>
        <hr>
        <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>TELEFONE</th>
                <th>ENDEREÇO</th>
                <th>E-MAIL</th>
                <th>DATA DE NASCIMENTO</th>
                <th>STATUS</th>
                <th>ACESSO</th>
                <th colspan="2">AÇÕES</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <?php foreach ($retorno->fetchall() as $value) { ?>
            <tr>
                <td> <?php echo $value['id'] ?> </td>
                <td> <?php echo $value['nome'] ?> </td>
                <td> <?php if (!empty($value['telefone'])) {
                                echo $value['telefone'];
                            } ?>
                    </td>
                <td> <?php echo $value['endereco'] ?> </td>
                <td> <?php if (!empty($value['emailProfessor'])) {
                                echo $value['emailProfessor'];
                            } ?>
                    </td>
                    <td> <?php if (!empty($value['datanascimento'])) {
                                echo $value['datanascimento'];
                            } ?>
                    </td>
                <td> <?php echo imprimirStatus($value['estatus']) ?> </td>
                <td> <?php echo $value['siape'] ?> </td>

                <td>
                    <form method="POST" action="AltProfessor.php">
                        <input name="id" id="professor"  type="hidden" value="<?php echo $value['id']; ?>" />
                        <button name="alterar" type="submit" class="btn-crud">Alterar</button>
                    </form>

                </td>

                <td>
                    <form method="GET" action="crudProfessor.php">
                        <input name="idProfessor" type="hidden" id="professor2" value="<?php echo $value['id']; ?>" />
                        <button name="excluir" type="submit" class="btn-crud delete">Excluir</button>
                    </form>
                    
                </td>



            </tr>
        <?php  }  ?>
        </tr>
        </tbody>
    </table>
        </div>
        <?php
echo "<button class='button button3'><a href='acesso-professor.html'>Voltar</a></button>";
?>
    </section>

</body>

</html>
