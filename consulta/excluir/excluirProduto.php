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
echo "<h1>Excluir Produto</h1>";

$cod = $_GET['id']; //codigo ou id?

include_once('../../config/conexao.php');

    $select = $conn->prepare("SELECT * from tb_produto where cd_produto=$cod");
    $select->execute();
    
    while($row = $select->fetch())
    {
        echo "<p>";
        echo "<br><b>Codigo: </b>".$row['cd_produto'];
        echo "<br><b>Produto: </b>".$row['nm_produto'];
        echo "<br><b>Codigo de Barras: </b>".$row['cd_barras'];
        echo "<br><b>NCM: </b>".$row['cd_ncm'];
        echo "<br><b>Preço: </b>".$row['vl_preco'];
        echo "<br><b>Custo: </b>".$row['vl_custo'];
        echo "<br><b>Descrição: </b>".$row['ds_produto'];
        echo "</p>";
        ?>
        <button onclick="window.location.href='./confirmarExcluir/confirmarExcluirProduto.php?id=<?php echo $row['cd_produto'];?>'">Excluir</button>
        <button onclick="window.location.href='../consultaProduto.php'">Voltar</button>
        <?php

    }

?>