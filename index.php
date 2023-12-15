<?php
session_start();

  if(!empty($_POST)){
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    include_once('config/conexao.php');

    $rs = $conn->query("SELECT * FROM tb_usuario where cd_cpf='$cpf' and
                        cd_senha='$senha'");

    $rs -> execute();

    if($rs->fetch(PDO::FETCH_ASSOC) == true)
    {
      $_SESSION["cpf"] = $cpf;
      header('Location:menu.php');
    }
    else{
      echo"<script>
          alert('Nome de usuário ou senha incorreto');
          </script>";
    }
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Forseti Office</title>
</head>
<body>

  <header>
    <nav>
      <img src="midia/Logo.png" alt="Logo Forseti Office">
      
      <div class="usuario">
        <button id="mostrar-modal" class="btn-login">Login</button>
      </div>
    </nav>
  </header>


  <main>
    <div class="container">

      <div class="titulo-principal">
        <h1>Conheça o Forseti Office e organize-se como advogado. </h1>
        <p>Ferramentas simples para controlar seu trabalho.</p>
        <button>Login</button>
      </div>
      <div class="img-lateral">
        <img src="midia/img-lateral.png" alt="Figura desenhada de advogados ">
      </div>

      <div class="popup">
        <div class="btn-fechar">&times;</div>
        <div class="form">
          <h2>Login</h2>
          <div class="form-element">
            <form action="#" method="POST">
            <label for="email">CPF</label>
            <input type="text" id="email" name="cpf" placeholder="Digite seu CPF">
          </div>
          <div class="form-element">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha">
          </div>
          <div class="form-element">
            <input class="btn-login-modal" type="submit" value="Entrar">
            </form>
          </div>
        </div>
      </div>


    </div>
  </main>

  <script src="script.js"></script>
</body>
</html>