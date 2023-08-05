<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Document</title>
  <style>
    .format-input {
      text-transform: uppercase;
    }
  </style>
</head>

<body>
  <section class="cadastro-usuario">
    <div class="identificacao-section">
      <img src="../assets/logotipo_logo.png" alt="">
      <h1 class="title-section">Cadastro de Professor</h1>
    </div>
    <hr>
    <form method="post" action="crudprofessor.php" class="form-cadastro" onsubmit="return validarFormulario()">

      <div class="dados-usuario">
        <div class="preenchimento-dados">
          <label for="nomeProfessor">Nome Completo:</label>
          <input type="text" name="nomeProfessor" minlength="10" class="format-input">
        </div>

        <div class="preenchimento-dados">
          <label for="telefoneProfessor">Telefone:</label>
          <input type="text" name="telefoneProfessor" id="telefone" maxlength="15" pattern="\(\d{2}\) \d{5}-\d{4}" placeholder="(XX) XXXXX-XXXX" required>

        </div>

        <div class="preenchimento-dados">
          <label for="enderecoProfessor">Endereço:</label>
          <input type="text" name="enderecoProfessor" class="format-input" minlength="10">
        </div>

        <div class="preenchimento-dados">
          <label for="emailProfessor">E-mail:</label>
          <input type="email" name="emailProfessor">
        </div>

        <div class="preenchimento-dados">
          <label for="senhaProfessor">Senha:</label>
          <input type="password" name="senhaProfessor">
        </div>

        <div class="preenchimento-dados">
          <label for="acessoProfessor">Acesso:</label>
          <input type="text" name="acessoProfessor" placeholder="Acesso de 10 dígitos" maxlength="10" size="10" class="format-input">
        </div>
      </div>

      <div class="preenchimento-dados">
        <label for="dtaNascimentoProfessor">Data de Nascimento:</label>
        <input type="date" name="datanascimentoProfessor" id="dtaNascimentoProfessor" required>
      </div>

      </div>

      <div class="btns-funcionais">
        <input type="submit" name="cadastrar" value="Cadastrar" id="cadastrar">
        <button class="button" type="button" onclick="window.location.href='acesso-professor.html'">Voltar</button>
      </div>
    </form>

  </section>

  <script>
    function validarFormulario() {
      // Obter os campos do formulário
      const nomeProfessor = document.querySelector('[name="nomeProfessor"]').value;
      const telefoneProfessor = document.querySelector('[name="telefoneProfessor"]').value;
      const emailProfessor = document.querySelector('[name="emailProfessor"]').value;
      const senhaProfessor = document.querySelector('[name="senhaProfessor"]').value;
      const acessoProfessor = document.querySelector('[name="acessoProfessor"]').value;
      const dtaNascimentoProfessor = document.getElementById('dtaNascimentoProfessor').value;

      // Validar Nome Completo
      if (nomeProfessor.length < 10) {
        alert("O Nome Completo deve ter no mínimo 10 caracteres.");
        return false;
      }

      // Validar Telefone
      if (!/\(\d{2}\) \d{5}-\d{4}/.test(telefoneProfessor)) {
        alert("Digite um telefone válido no formato (XX) XXXXX-XXXX.");
        return false;
      }

      // Validar E-mail
      if (!/^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/.test(emailProfessor)) {
        alert("Digite um e-mail válido.");
        return false;
      }

      // Validar Senha
      if (senhaProfessor.length < 6) {
        alert("A senha deve ter no mínimo 6 caracteres.");
        return false;
      }

      // Validar Acesso
      if (!/^\d{10}$/.test(acessoProfessor)) {
        alert("O acesso deve conter exatamente 10 dígitos numéricos.");
        return false;
      }

      return true; // Envia o formulário se todas as validações passarem
    }


    function aplicarMascaraTelefone(event) {
  const input = event.target;
  const keyCode = event.keyCode || event.which;
  const numero = input.value.replace(/\D/g, ''); // Remover caracteres não numéricos
  let formatado = `(${numero.substring(0, 2)}) ${numero.substring(2, 7)}`;

  if (numero.length > 7) {
    formatado += `-${numero.substring(7, 11)}`;
  }

  // Verificar se a tecla pressionada é a tecla "backspace" (código 8)
  // ou se o caractere a ser apagado é o parêntese "(" (código 40) ou ")"
  // ou se é o hífen (código 189) ou a barra (código 191)
  if (
    keyCode === 8 ||
    keyCode === 40 || // Código para o parêntese "("
    keyCode === 41 || // Código para o parêntese ")"
    keyCode === 189 || // Código para o hífen "-"
    keyCode === 191 // Código para a barra "/"
  ) {
    // Restaurar o valor formatado sem o caractere removido
    input.value = formatado;
    return;
  }

  input.value = formatado;
}

// Selecionar o campo de telefone e adicionar o evento de input para aplicar a máscara
const telefoneInput = document.getElementById('telefone');
telefoneInput.addEventListener('input', aplicarMascaraTelefone);


  </script>


</body>

</html>