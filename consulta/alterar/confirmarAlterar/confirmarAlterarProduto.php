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
$barras = $_POST['barras'];
$ncm = $_POST['NCM'];
$preco = $_POST['preco'];
$tipo = $_POST['tipo'];
$desc = $_POST['descricao'];

	try 
	{

		$stmt = $conn->prepare("UPDATE tb_produto SET nm_produto = :nome,
													  cd_barras = :barras,
													  cd_ncm = :ncm,
													  ds_tipo = :tipo,
                                                      vl_preco = :preco,
                                                      ds_produto = :descr WHERE cd_produto = :id");

		$stmt->execute(array(':id' => $cod, 
							 ':nome' => $nome,
							 ':barras' => $barras,
							 ':ncm' => $ncm,
                             ':tipo' => $tipo,
                             ':preco' => $preco,
							 ':descr' => $desc));
		
		header( "refresh:0;url=../../consultaProduto.php" );

		echo "<script>alert('PRODUTO ALTERADO COM SUCESSO');</script>";


	} 

	catch(PDOException $e) 

	{

		echo 'Error: ' . $e->getMessage();

	}

	

 ?>