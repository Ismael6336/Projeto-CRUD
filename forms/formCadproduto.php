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
    <title>CADASTRO DE PRODUTO</title>
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
      				<h2 class="bg-primary text-white">Cadastro de Produto</h2>

      				<form action="#" method="POST" enctype="multipart/form-data">
	  					<label class="form-label">Nome:</label>
	  					<input type="text" class="form-control" id="nome" name="nomeProduto">
	  					<label class="form-label">Código de Barras:</label>
	  					<input type="text" class="form-control" id="barras" name="barras" maxlength="43">
	  					<label class="form-label">Tipo do Produto:</label>
	  					<input type="text" class="form-control" id="tipo" name="tipoProduto">
	  					<label class="form-label">Ncm:</label>
	  					<input type="text" class="form-control" id="ncm" name="ncm">
	  					<label class="form-label">Preço:</label>
	  					<input type="text" class="form-control" id="preco" name="preco">
	  					<label class="form-label">Custo:</label>
	  					<input type="text" class="form-control" id="custo" name="custo">
	  					<label class="form-label">Descrição:</label>
	  					<input type="text" class="form-control" id="descricao" name="descricao" maxlength="200">
						  
							<label class="form-label">Foto:</label>
							<input type="file" class="form-control" name="imgProduto">
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
	
	$nome = $_POST['nomeProduto'];
	$codigo = $_POST['barras'];
	$tipo = $_POST['tipoProduto'];
	$ncm = $_POST['ncm'];
	$preco = $_POST['preco'];
	$custo = $_POST['custo'];
	$descricao = $_POST['descricao'];

	$imagem = $_FILES['imgProduto'];
	$dir = "../img/produtos/";
	
	date_default_timezone_set('America/Sao_Paulo');
	$extensao = strtolower(substr($imagem['name'], -4));
	$novo_nome = date("Y.m.d-H.i.s") . $extensao;
	move_uploaded_file($imagem['tmp_name'], $dir.$novo_nome);
	$caminhoIMG = $dir.$novo_nome;

	include_once('../config/conexao.php');

	try {
		
	  $stmt = $conn->prepare("INSERT INTO tb_produto (nm_produto, cd_barras, ds_tipo, cd_ncm, vl_preco, vl_custo, ds_produto, ds_imagem)
	  	                      VALUES (:nome, :codigo, :tipo, :ncm, :preco, :custo, :descricao, :img)");

	  $stmt->bindParam(':nome', $nome);
	  $stmt->bindParam(':codigo', $codigo);
	  $stmt->bindParam(':tipo', $tipo);
	  $stmt->bindParam(':ncm', $ncm);
	  $stmt->bindParam(':preco', $preco);
	  $stmt->bindParam(':custo', $custo);
	  $stmt->bindParam(':descricao', $descricao);
      $stmt->bindParam(':img', $caminhoIMG);

	  $stmt->execute();

	  echo "<script>alert('Cadastrado com Sucesso');</script>";

	} catch(PDOException $e) {
	  echo "Erro ao cadastrar: " . $e->getMessage();
	}
	$conn = null;
}
?>