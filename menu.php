<?php
session_start();
include_once('config/conexao.php');
if(isset($_SESSION['cpf']))
{
  $rs = $conn->prepare("SELECT nm_usuario, cd_nivel FROM tb_usuario where 
                      cd_cpf ='". $_SESSION['cpf']."'");
  $rs->execute();
  $row = $rs->fetch();
}
else
{
  echo "
  <script>
    window.location.href='index.php';
  </script>";	
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
      <ul class="dropdown">
      <?php if($row['cd_nivel'] == 0) {?>
        <li><a href="#">Cadastro</a>
        <ul  class="menu">
          <li>
            <a href="forms/formCadCliente.php">Cliente</a>
            <a href="forms/formCadfornecedor.php">Fornecedor</a>
            <a href="forms/formCadfuncionario.php">Funcionario</a>
            <a href="forms/formCadproduto.php">Produto</a>
            <a href="forms/formCadusuario.php">Usuario</a>
          </li>
        </ul>
      <?php }?>

        </li>
        <li><a href="#">Consulta</a>
          <ul class="menu">
            <li>
              <a href="consulta/consultaCliente.php">Cliente</a>
              <a href="consulta/consultaFornecedor.php">Fornecedor</a>
              <a href="consulta/consultaFuncionario.php">Funcionario</a>
              <a href="consulta/consultaProduto.php">Produto</a>
              <a href="consulta/consultaUsuario.php">Usuario</a>
            </li>
        </ul>

    </li>
        <li><a href="sair.php">Sair</a></li>
      </ul>
      <div class="usuario">
        <a href="">Olá, <?php echo $row['nm_usuario'];?></a>
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

    </div>
  </main>

  <script src="script.js"></script>
</body>
</html>