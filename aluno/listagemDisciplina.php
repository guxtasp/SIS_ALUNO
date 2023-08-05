
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
    <title>Document</title>
</head>

<body>
<?php

require_once('../conexao.php');

$retorno = $conexao->prepare('SELECT *FROM disciplina');
$retorno->execute();

?>
    <section class="direcionador-paginas" id="lista-usuario">
        <div class="identificacao-section">
            <img src="assets/logotipo_logo.png" alt="">
            <h1 class="title-section">Sessão de matrículas</h1>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Infelizmente, essa funcionalidade está em fase de construção devido empecilhos no banco de dados.
            </div>
        </div>
        <hr>
        <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>CARGA HORÁRIA</th>
                <th>ID (PROFESSOR)</th>
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
                <td> <?php echo $value['idprofessor'];?> 
            </td>
                <td>
                    <form method="POST" action="matricularDisciplina.php">
                        <input name="codDisciplina" id="professor"  type="hidden" value="<?php echo $value['id']; ?>" />
                        <button name="alterar" type="submit" class="btn-crud">Matricular</button>
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
