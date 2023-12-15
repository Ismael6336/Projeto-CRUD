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
echo "<h1>Excluir Fornecedor</h1>";

$cod = $_GET['id']; //codigo ou id?

include_once('../../config/conexao.php');

    $select = $conn->prepare("SELECT * from tb_fornecedor where cd_fornecedor=$cod");
    $select->execute();
    
    while($row = $select->fetch())
    {
        echo "<p>";
        echo "<br><b>Codigo: </b>".$row['cd_fornecedor'];
        echo "<br><b>Fornecedor: </b>".$row['nm_fornecedor'];
        echo "<br><b>CNPJ: </b>".$row['cd_cnpj'];
        echo "<br><b>IE: </b>".$row['cd_ie'];
        echo "<br><b>Razao Social: </b>".$row['nm_razaosocial'];
        echo "<br><b>Nome Fantasia: </b>".$row['nm_fantasia'];
        echo "<br><b>CEP: </b>".$row['cd_cep'];
        echo "<br><b>Logradouro: </b>".$row['ds_residencia'];
        echo "<br><b>Telefone: </b>".$row['cd_telefone'];
        echo "<br><b>Celular: </b>".$row['cd_celular'];
        echo "<br><b>Email: </b>".$row['nm_email'];
        echo "</p>";
        ?>
        <button onclick="window.location.href='./confirmarExcluir/confirmarExcluirFornecedor.php?id=<?php echo $row['cd_fornecedor'];?>'">Excluir</button>
        <button onclick="window.location.href='../consultaFornecedor.php'">Voltar</button>
        <?php

    }


?>