<?php
session_start();
include_once('../config/conexao.php');
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
    window.location.href='../index.php';
  </script>";	
}
?>
<!doctype html>
<html lang='pt-br'>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>SISTEMA COMERCIAL - CONSULTA PRODUTO</title>
</head>
<body>
	
<?php  
	
	include_once('../config/conexao.php');
	try 
	{	   
		$select = $conn->prepare('SELECT * FROM tb_produto');
		$select->execute();
	  
		while($row = $select->fetch()) 
		{
			echo "<p>";
			echo "<br><img src='".$row['ds_imagem']."' width=80px;>";
			echo "<br><b>Codigo: </b>".$row['cd_produto'];
			echo "<br><b>Nome: </b>".$row['nm_produto'];
			echo "<br><b>Código de Barras: </b>".$row['cd_barras'];
			echo "<br><b>Tipo do Produto: </b>".$row['ds_tipo'];
			echo "<br><b>NCM: </b>".$row['cd_ncm'];
			echo "<br><b>Preço: </b>".$row['vl_preco'];
			echo "<br><b>Custo de Produção: </b>".$row['vl_custo'];
			echo "<br><b>Descrição: </b>".$row['ds_produto'];
			echo "<hr>";
            ?>

			<input type="button" name="Alterar" value="Alterar" class="btn btn-primary" onclick="javascript: location.href='./alterar/alterarProduto.php?id=<?php echo $row['cd_produto']; ?>' "/>

			<input type="button" name="Excluir" value="Excluir" class="btn btn-primary" onclick="javascript: location.href='./excluir/excluirProduto.php?id=<?php echo $row['cd_produto']; ?>' "/>

			<?php
		}
	}
	catch(PDOException $e) 
	{
		echo 'ERROR: ' . $e->getMessage();
	}
 ?>
	
	</div>
 </body>
<html>