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
   <title>SISTEMA COMERCIAL - CONSULTA FORNECEDOR</title>
</head>
<body>
	
<?php  
	
	include_once('../config/conexao.php');
	try 
	{	   
		$select = $conn->prepare('SELECT * FROM tb_fornecedor');
		$select->execute();
	  
		while($row = $select->fetch()) 
		{
			echo "<p>";
			echo "<br><img src='".$row['ds_imagem']."' width=80px;>";
			echo "<br><b>Codigo: </b>".$row['cd_fornecedor'];
			echo "<br><b>CNPJ: </b>".$row['cd_cnpj'];
			echo "<br><b>IE: </b>".$row['cd_ie'];
            echo "<br><b>Razão Social: </b>".$row['nm_razaosocial'];
            echo "<br><b>Nome Fantasia: </b>".$row['nm_fantasia'];
			echo "<br><b>CEP: </b>".$row['cd_cep'];
			echo "<br><b>Logradouro: </b>".$row['ds_residencia'];
			echo "<br><b>Telefone: </b>".$row['cd_telefone'];
			echo "<br><b>Celular: </b>".$row['cd_celular'];
			echo "<br><b>Email: </b>".$row['nm_email'];
			echo "<hr>";
            ?>

			<input type="button" name="Alterar" value="Alterar" class="btn btn-primary" onclick="javascript: location.href='./alterar/alterarFornecedor.php?id=<?php echo $row['cd_fornecedor']; ?>' "/>

			<input type="button" name="Excluir" value="Excluir" class="btn btn-primary" onclick="javascript: location.href='./excluir/excluirFornecedor.php?id=<?php echo $row['cd_fornecedor']; ?>' "/>

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