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
    <title>CADASTRO DE FORNECEDOR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="js/buscaCep.js"> </script>
		<script src="js/validaCNPJ.js"> </script>
		
  </head>
<body>
	<div class="container">
  		<div class="row">
    		<div class="col">
      			
    		</div>
    		<div class="col">
      			<div class="mb-3">
      				<h2 class="bg-primary text-white">Cadastro de Fornecedor</h2>

      				<form action="#" method="POST" enctype="multipart/form-data">
	  					<label class="form-label">CNPJ:</label>
	  					<input type="text" class="form-control" id="cnpjFornecedor" name="cnpjFornecedor" onblur="validarCNPJ(this.value)">
	  					<label class="form-label">IE:</label>
	  					<input type="text" class="form-control" id="IEFornecedor" name="IEFornecedor">
							<label class="form-label">Razão Social:</label>
	  					<input type="text" class="form-control" id="razao" name="razaosocial">
              <label class="form-label">Nome Fantasia:</label>
	  					<input type="text" class="form-control" id="nomefant" name="nomefantasia">
	  					<label class="form-label">CEP:</label>
	  					<input type="text" class="form-control" id="cep" name="cepFornecedor" onblur="pesquisacep(this.value);">
	  					<label class="form-label">Rua:</label>
	  					<input type="text" class="form-control" id="rua" name="ruaFornecedor">
	  					<label class="form-label">Logradouro:</label>
	  					<input type="text" class="form-control" id="logFornecedor" name="logFornecedor">
	  					<label class="form-label">Bairro:</label>
	  					<input type="text" class="form-control" id="bairro" name="bairroFornecedor">
	  					<label class="form-label">Cidade:</label>
	  					<input type="text" class="form-control" id="cidade" name="cidadeFornecedor">
	  					<label class="form-label">Estado:</label>
	  					<input type="text" class="form-control" id="uf" name="ufFornecedor">
	  					<label class="form-label">Celular:</label>
	  					<input type="text" class="form-control" id="celularFornecedor" name="celularFornecedor">
              <label class="form-label">Telefone:</label>
	  					<input type="text" class="form-control" id="telFornecedor" name="telFornecedor">
	  					<label class="form-label">Email:</label>
	  					<input type="text" class="form-control" id="emailFornecedor" name="emailFornecedor">
						  
						<label class="form-label">Foto:</label>
						<input type="file" class="form-control" name="imgFornecedor">

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



<?php


if(!empty($_POST))
{
	
	$cnpj = $_POST['cnpjFornecedor'];
	$IE = $_POST['IEFornecedor'];
	$fantasia = $_POST['nomefantasia'];
 	$razao = $_POST['razaosocial'];
	$cep = $_POST['cepFornecedor'];
	$log = $_POST['logFornecedor'];
	$celular = $_POST['celularFornecedor'];
	$tel = $_POST['telFornecedor'];
	$email = $_POST['emailFornecedor'];

	
	$imagem = $_FILES['imgFornecedor'];
	$dir = "../img/fornecedores/";
	
	date_default_timezone_set('America/Sao_Paulo');
	$extensao = strtolower(substr($imagem['name'], -4));
	$novo_nome = date("Y.m.d-H.i.s") . $extensao;
	move_uploaded_file($imagem['tmp_name'], $dir.$novo_nome);
	$caminhoIMG = $dir.$novo_nome;


	include_once('../config/conexao.php');

	try {
		
	  $stmt = $conn->prepare("INSERT INTO tb_fornecedor (cd_cnpj, cd_ie, nm_razaosocial, nm_fantasia, cd_cep, ds_residencia, cd_telefone, cd_celular, nm_email, ds_imagem)
	  	                      VALUES (:cnpj, :ie, :razao, :fantasia, :cep, :ds, :celular, :tel, :email, :img)");

	  $stmt->bindParam(':cnpj', $cnpj);
	  $stmt->bindParam(':ie', $IE);
	  $stmt->bindParam(':razao', $razao);
      $stmt->bindParam(':fantasia', $fantasia);
	  $stmt->bindParam(':cep', $cep);
	  $stmt->bindParam(':ds', $log);
	  $stmt->bindParam(':celular', $celular);
	  $stmt->bindParam(':tel', $tel);
	  $stmt->bindParam(':email', $email);
	  $stmt->bindParam(':img', $caminhoIMG);
	  
	  $stmt->execute();

	  echo "<script>alert('Cadastrado com Sucesso');</script>";

	} catch(PDOException $e) {
	  echo "Erro ao cadastrar: " . $e->getMessage();
	}
	$conn = null;
}
?>
</html>