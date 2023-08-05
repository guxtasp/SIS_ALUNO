<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Matricular Disciplina</title>
</head>

<body>
    <section class="direcionador-paginas" id="matricular-disciplina">
        <div class="identificacao-section">
            <img src="assets/logotipo_logo.png" alt="">
            <h1 class="title-section">Matricular Disciplina</h1>
        </div>
        <hr>
        <form method="POST" action="processarMatricula.php">
            <label for="idAluno">ID ou Nome do Aluno:</label>
            <input type="text" id="id" name="id" required>
            <br>
            <input name="id" type="hidden" value="<?php echo $_POST['id']; ?>" />
            <button type="submit" class="btn-crud">Matricular</button>
        </form>
        <?php
        echo "<button class='button button3'><a href='acesso-aluno.html'>Voltar</a></button>";
        ?>
    </section>
</body>

</html>
