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
$razao = $_POST['razao'];
$cnpj = $_POST['cnpj'];
$ie = $_POST['ie'];
$cep = $_POST['cep'];
$resi = $_POST['numero'];
$tel = $_POST['telefone'];
$cel = $_POST['celular'];
$email = $_POST['email'];

	try 
	{

		$stmt = $conn->prepare("UPDATE tb_fornecedor SET cd_cnpj = :cnpj,
													  cd_ie = :ie,
                                                      nm_razaosocial = :razao,
                                                      nm_fantasia = :nome,
													  cd_cep = :cep,
													  ds_residencia = :resi,
													  cd_celular = :cel,
                                                      cd_telefone = :tel,
                                                      nm_email = :email WHERE cd_fornecedor = :id");
                                                      

		$stmt->execute(array(':id' => $cod, 
							 ':nome' => $nome,
                             ':razao' => $razao,
							 ':cnpj' => $cnpj,
							 ':ie' => $ie,
							 ':cep' => $cep,
							 ':resi' => $resi,
                             ':cel' => $cel,
                             ':tel' => $tel,
                             ':email' => $email));
		
		header( "refresh:0;url=../../consultaFornecedor.php" );

		echo "<script>alert('FORNECEDOR ALTERADO COM SUCESSO');</script>";


	} 

	catch(PDOException $e) 

	{

		echo 'Error: ' . $e->getMessage();

	}

	

 ?>