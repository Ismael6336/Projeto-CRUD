<?php
session_start();
include_once('../config/conexao.php');
if(isset($_SESSION['cpf']))
{
  $rs = $conn->prepare("SELECT nm_usuario, cd_nivel FROM tb_usuario where 
                      cd_cpf ='". $_SESSION['cpf']."'");
  $rs->execute();
  $row = $rs->fetch();
  if($row['cd_nivel'] == 1) {
	echo "
	<script>
	  window.location.href='../index.php';
	</script>";
  }
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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CADASTRO DE CLIENTE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="js/buscaCep.js"> </script>
		<script src="js/validaCPF.js"> </script>
  </head>
<body>
	<div class="container">
  		<div class="row">
    		<div class="col">
      			
    		</div>
    		<div class="col">
      			<div class="mb-3">
      				<h2 class="bg-primary text-white">Cadastro de Cliente</h2>

      				<form action="#" method="POST" enctype="multipart/form-data">
	  					<label class="form-label">Nome:</label>
	  					<input type="text" class="form-control" id="nomeCliente" name="nomeCliente">
	  					<label class="form-label">CPF:</label>
	  					<input type="text" class="form-control" id="cpfCliente" name="cpfCliente" onblur="TestaCPF(this.value);">
	  					<label class="form-label">RG:</label>
	  					<input type="text" class="form-control" id="rgCliente" name="rgCliente">
							<label class="form-label">Nascimento:</label>
	  					<input type="date" class="form-control" id="dtnascimento" name="dtnasci">
							<label class="form-label">Sexo:</label>
	  					<input type="text" class="form-control" id="sexo" name="sexo">
	  					<label class="form-label">CEP:</label>
	  					<input type="text" class="form-control" id="cep" name="cepCliente" onblur="pesquisacep(this.value);">
	  					<label class="form-label">Rua:</label>
	  					<input type="text" class="form-control" id="rua" name="ruaCliente">
	  					<label class="form-label">Logradouro:</label>
	  					<input type="text" class="form-control" id="logCliente" name="logCliente">
	  					<label class="form-label">Bairro:</label>
	  					<input type="text" class="form-control" id="bairro" name="bairroCliente">
	  					<label class="form-label">Cidade:</label>
	  					<input type="text" class="form-control" id="cidade" name="cidadeCliente">
	  					<label class="form-label">Estado:</label>
	  					<input type="text" class="form-control" id="uf" name="ufCliente">
	  					<label class="form-label">Telefone:</label>
	  					<input type="text" class="form-control" id="telCliente" name="telCliente">
	  					<label class="form-label">Celular:</label>
	  					<input type="text" class="form-control" id="celularCliente" name="celularCliente">
	  					<label class="form-label">Email:</label>
	  					<input type="text" class="form-control" id="emailCliente" name="emailCliente">

						<label class="form-label">Foto:</label>
						<input type="file" class="form-control" name="imgCliente">

	  					<br>
	  					<div class="text-center">
	  						<input type="submit" name="Cadastrar" class="btn btn-primary">
	  						<input type="reset" name="Limpar" class="btn btn-danger">
	  					</div>
					</form>
				</div>
    		</div>
    		<div class="col">
      			
    		</div>
  		</div>
	</div>
</body>
</html>


<?php


if(!empty($_POST))
{
	
	$nome = $_POST['nomeCliente'];
	$cpf = $_POST['cpfCliente'];
	$rg = $_POST['rgCliente'];
	$nasc = $_POST['dtnasci'];
	$sexo = $_POST['sexo'];
	$cep = $_POST['cepCliente'];
	$log = $_POST['logCliente'];
	$tel = $_POST['telCliente'];
	$celular = $_POST['celularCliente'];
	$email = $_POST['emailCliente'];

	$imagem = $_FILES['imgCliente'];
	$dir = "../img/clientes/"; 

	date_default_timezone_set('America/Sao_Paulo');
	$extensao = strtolower(substr($imagem['name'], -4));
	$novo_nome = date("Y.m.d-H.i.s") . $extensao;
	move_uploaded_file($imagem['tmp_name'], $dir.$novo_nome);
	$caminhoIMG = $dir.$novo_nome;

	include_once('../config/conexao.php');

	try {
		
	  $stmt = $conn->prepare("INSERT INTO tb_Cliente (nm_cliente, cd_cpf, cd_rg, dt_nascimento, nm_sexo, cd_cep, ds_residencia, cd_telefone, cd_celular, nm_email, ds_imagem)
	  	                      VALUES (:nome, :cpf, :rg, :nasc, :sexo, :cep, :ds, :tel, :celular, :email, :imagem)");

	  $stmt->bindParam(':nome', $nome);
	  $stmt->bindParam(':cpf', $cpf);
	  $stmt->bindParam(':rg', $rg);
	  $stmt->bindParam(':nasc', $nasc);
	  $stmt->bindParam(':sexo', $sexo);
	  $stmt->bindParam(':cep', $cep);
	  $stmt->bindParam(':ds', $log);
	  $stmt->bindParam(':tel', $tel);
	  $stmt->bindParam(':celular', $celular);
	  $stmt->bindParam(':email', $email);
	  $stmt->bindParam(':imagem', $caminhoIMG);
	  
	  $stmt->execute();

	  echo "<script>alert('Cadastrado com Sucesso');</script>";

	} catch(PDOException $e) {
	  echo "Erro ao cadastrar: " . $e->getMessage();
	}
	$conn = null;
}
?>