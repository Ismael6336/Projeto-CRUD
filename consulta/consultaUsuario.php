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
   <title>SISTEMA COMERCIAL - CONSULTA USUARIO</title>
</head>
<body>
	
<?php  
	
	include_once('../config/conexao.php');
	try 
	{	   
		$select = $conn->prepare('SELECT * FROM tb_usuario');
		$select->execute();
	  
		while($row = $select->fetch()) 
		{
			echo "<p>";
			echo "<br><img src='".$row['ds_imagem']."' width=80px;>";
			echo "<br><b>Codigo: </b>".$row['cd_usuario'];
			echo "<br><b>Login: </b>".$row['cd_cpf'];
			echo "<br><b>Senha: </b>".$row['cd_senha'];
			echo "<br><b>Código do Funcionário: </b>".$row['cd_funcionario'];
			echo "<hr>";
            ?>

			<input type="button" name="Alterar" value="Alterar" class="btn btn-primary" onclick="javascript: location.href='./alterar/alterarUsuario.php?id=<?php echo $row['cd_usuario']; ?>' "/>

			<input type="button" name="Excluir" value="Excluir" class="btn btn-primary" onclick="javascript: location.href='./excluir/excluirUsuario.php?id=<?php echo $row['cd_usuario']; ?>' "/>

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