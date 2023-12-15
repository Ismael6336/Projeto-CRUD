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
<?php

include_once('../../../config/conexao.php');



$cod = $_POST['codigo']; 
$nome = $_POST['nome'];
$senha = $_POST['senha'];

	try 
	{

		$stmt = $conn->prepare("UPDATE tb_usuario SET cd_cpf = :nome,
													  cd_senha = :senha WHERE cd_usuario = :id");

		$stmt->execute(array(':id' => $cod, 
							 ':nome' => $nome,
							 ':senha' => $senha));
		
		header( "refresh:0;url=../../consultaUsuario.php" );

		echo "<script>alert('USUARIO ALTERADO COM SUCESSO');</script>";


	} 

	catch(PDOException $e) 

	{

		echo 'Error: ' . $e->getMessage();

	}

	

 ?>