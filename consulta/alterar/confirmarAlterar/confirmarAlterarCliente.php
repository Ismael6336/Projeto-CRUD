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
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$cep = $_POST['cep'];
$resi = $_POST['numero'];
$tel = $_POST['telefone'];
$cel = $_POST['celular'];
$email = $_POST['email'];

	try 
	{

		$stmt = $conn->prepare("UPDATE tb_cliente SET nm_cliente = :nome,
													  cd_cpf = :cpf,
													  cd_rg = :rg,
													  cd_cep = :cep,
													  ds_residencia = :resi,
                                                      cd_telefone = :tel,
													  cd_celular = :cel,
                                                      nm_email = :email WHERE cd_cliente = :id");

		$stmt->execute(array(':id' => $cod, 
							 ':nome' => $nome,
							 ':cpf' => $cpf,
							 ':rg' => $rg,
							 ':cep' => $cep,
							 ':resi' => $resi,
                             ':cel' => $cel,
                             ':tel' => $tel,
                             ':email' => $email));
		
		header( "refresh:0;url=../../consultaCliente.php" );

		echo "<script>alert('CLIENTE ALTERADO COM SUCESSO');</script>";


	} 

	catch(PDOException $e) 

	{

		echo 'Error: ' . $e->getMessage();

	}

	

 ?>