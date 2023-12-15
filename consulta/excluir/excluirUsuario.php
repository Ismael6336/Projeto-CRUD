<?php
session_start();
include_once('../../config/conexao.php');
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
    window.location.href='../../index.php';
  </script>";	
}
?>
<meta charset='utf-8'>
<?php
echo "<h1>Excluir Usuario</h1>";

$cod = $_GET['id']; //codigo ou id?

include_once('../../config/conexao.php');

    $select = $conn->prepare("SELECT * from tb_usuario where cd_usuario=$cod");
    $select->execute();
    
    while($row = $select->fetch())
    {
            echo "<p>";
			echo "<br><b>Codigo: </b>".$row['cd_usuario'];
			echo "<br><b>Login: </b>".$row['cd_cpf'];
			echo "<br><b>Senha: </b>".$row['cd_senha'];
			echo "<br><b>Código do Funcionário: </b>".$row['cd_funcionario'];
			echo "<hr>";
        ?>
        <button onclick="window.location.href='./confirmarExcluir/confirmarExcluirUsuario.php?id=<?php echo $row['cd_usuario'];?>'">Excluir</button>
        <button onclick="window.location.href='../consultaUsuario.php'">Voltar</button>
        <?php

    }

?>