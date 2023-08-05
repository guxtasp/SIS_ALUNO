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

    $retorno = $conexao->prepare('SELECT * FROM aluno');
    $retorno->execute();

    function imprimirStatus($valor)
    {
        // Verifica se o valor é igual a 1 ou true
        if ($valor === 'MT' || $valor === '1' || $valor === 'true'  ) {
            return "ATIVO";
        } else {
            return "INATIVO";
        }
    }

    ?>
    <section class="direcionador-paginas" id="lista-usuario">
        <div class="identificacao-section">
            <img src="assets/logotipo_logo.png" alt="">
            <h1 class="title-section">Lista de Discentes</h1>
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
                    <th>MATRÍCULA</th>
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
                    <td>

                        <?php
                        if (!empty($value['email'])) {
                            echo $value['email'];
                        }
                        ?>
                    </td>
                    <td> <?php echo $value['datanascimento'] ?> </td>
                    <td> <?php echo imprimirStatus($value['estatus']) ?> </td>
                    <td> <?php echo $value['matricula'] ?> </td>

                    <td>
                        <form method="POST" action="Altaluno.php">
                            <input name="idAluno" id="Aluno" type="hidden" value="<?php echo $value['id']; ?>" />
                            <button name="alterar" type="submit" class="btn-crud">Alterar</button>
                        </form>

                    </td>

                    <td>
                        <form method="GET" action="crudaluno.php">
                            <input name="idAluno" type="hidden" id="Aluno2" value="<?php echo $value['id']; ?>" />
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
        echo "<button class='button button3'><a href='acesso-aluno.html'>Voltar</a></button>";
        ?>
    </section>

</body>

</html>