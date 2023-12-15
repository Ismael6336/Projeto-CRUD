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
echo "<h1>Excluir Fornecedor</h1>";

$cod = $_GET['id'];

include_once('../../../config/conexao.php');

    $delete = $conn->prepare("DELETE from tb_fornecedor where cd_fornecedor=$cod");
    $delete->execute();
    
    
        ?>
        <br>
        <button onclick="window.locations.href='../../consultaFornecedor.php'">Voltar</button>
        <?php

?>