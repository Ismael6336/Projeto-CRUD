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
   <title>SISTEMA COMERCIAL - CONSULTA CLIENTE</title>
</head>
<body>
	
<?php  
	
	include_once('../config/conexao.php');
	try 
	{	   
		$select = $conn->prepare('SELECT * FROM tb_cliente');
		$select->execute();
	  
		while($row = $select->fetch()) 
		{
			echo "<p>";
			echo "<br><img src='".$row['ds_imagem']."' width=80px;>";
			echo "<br><b>Codigo: </b>".$row['cd_cliente'];
			echo "<br><b>Nome: </b>".$row['nm_cliente'];
			echo "<br><b>CPF: </b>".$row['cd_cpf'];
			echo "<br><b>RG: </b>".$row['cd_rg'];
			echo "<br><b>CEP: </b>".$row['cd_cep'];
			echo "<br><b>Logradouro: </b>".$row['ds_residencia'];
			echo "<br><b>Telefone: </b>".$row['cd_telefone'];
			echo "<br><b>Celular: </b>".$row['cd_celular'];
			echo "<br><b>Email: </b>".$row['nm_email'];
			echo "<hr>";
			?>

			<input type="button" name="Alterar" value="Alterar" class="btn btn-primary" onclick="javascript: location.href='./alterar/alterarCliente.php?id=<?php echo $row['cd_cliente']; ?>' "/>

			<input type="button" name="Excluir" value="Excluir" class="btn btn-primary" onclick="javascript: location.href='./excluir/excluirCliente.php?id=<?php echo $row['cd_cliente']; ?>' "/>

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