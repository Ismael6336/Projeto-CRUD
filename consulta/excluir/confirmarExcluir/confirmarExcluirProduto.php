<?php
session_start();
include_once('../../../config/conexao.php');
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
    window.location.href='../../../index.php';
  </script>";	
}
?>
<meta charset='utf-8'>
<?php
echo "<h1>Excluir Cliente</h1>";

$cod = $_GET['id']; //codigo ou id?

include_once('../../../config/conexao.php');

    $delete = $conn->prepare("DELETE from tb_produto where cd_produto=$cod");
    $delete->execute();
    
    
        ?>
        <br>
        <button onclick="window.location.href='../../consultaProduto.php'">Voltar</button>
        <?php

    ?>