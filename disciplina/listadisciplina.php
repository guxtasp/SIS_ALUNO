
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

$retorno = $conexao->prepare('SELECT * 
FROM Disciplina order by nomedisciplina');
$retorno->execute();

?>
    <section class="direcionador-paginas" id="lista-usuario">
        <div class="identificacao-section">
            <img src="assets/logotipo_logo.png" alt="">
            <h1 class="title-section">Lista de Disciplinas</h1>
        </div>
        <hr>
        <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>CARGA HORÁRIA</th>
                <th>PROFESSOR</th>
                <th colspan="2">AÇÕES</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <?php foreach ($retorno->fetchall() as $value) { ?>
            <tr>
                <td> <?php echo $value['id'] ?> </td>
                <td> <?php echo $value['nomedisciplina'] ?> </td>
                <td> <?php echo $value['ch'] ?> </td>
                <td> <?php echo $value['idprofessor'];
                ?> 
            </td>
                <td>
                    <form method="POST" action="Altdisciplina.php">
                        <input name="codDisciplina" id="professor"  type="hidden" value="<?php echo $value['id']; ?>" />
                        <button name="alterar" type="submit" class="btn-crud">Alterar</button>
                    </form>
                </td>

                <td>
                    <form method="GET" action="cruddisciplina.php">
                        <input name="codDisciplina" type="hidden" id="professor2"  value="<?php echo $value['id']; ?>" />
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
echo "<button class='button button3'><a href='acesso-disciplina.html'>Voltar</a></button>";
?>
    </section>

</body>

</html>
