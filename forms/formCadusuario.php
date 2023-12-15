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
    <title>CADASTRO DE USUARIO</title>
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
      				<h2 class="bg-primary text-white">Cadastro de Usuario</h2>

      				<form action="#" method="POST" enctype="multipart/form-data">
	  					<label class="form-label">CPF:</label>
							<input type="text" class="form-control" id="login" name="login">
							<label class="form-label">Nome:</label>
							<input type="text" class="form-control" id="nome" name="nome">
	  					<label class="form-label">Senha:</label>
	  					<input type="password" class="form-control" id="senha" name="senha">
							<label class="form-label">Nível:</label>
							<input type="text" class="form-control" id="nivel" name="nivel">
							<label class="form-label">Foto:</label>
							<input type="file" class="form-control" name="imgUsuario">
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
	
	$login = $_POST['login'];
	$nome = $_POST['nome'];
	$nivel = $_POST['nivel'];
	$senha = $_POST['senha'];

	$imagem = $_FILES['imgUsuario'];
	$dir = "../img/usuarios/";
	
	date_default_timezone_set('America/Sao_Paulo');
	$extensao = strtolower(substr($imagem['name'], -4));
	$novo_nome = date("Y.m.d-H.i.s") . $extensao;
	move_uploaded_file($imagem['tmp_name'], $dir.$novo_nome);
	$caminhoIMG = $dir.$novo_nome;
	

	include_once('../config/conexao.php');

	try {
		
	  $stmt = $conn->prepare("INSERT INTO tb_usuario (cd_cpf, nm_usuario, cd_senha, ds_imagem, cd_nivel)
	  	                      VALUES (:log, :nome, :senha, :img, :nivel)");

	  $stmt->bindParam(':log', $login);
	  $stmt->bindParam(':nivel', $nivel);
	  $stmt->bindParam(':senha', $senha);
		$stmt->bindParam(':img', $caminhoIMG);
		$stmt->bindParam(':nome', $nome);

	  $stmt->execute();

	  echo "<script>alert('Cadastrado com Sucesso');</script>";

	} catch(PDOException $e) {
	  echo "Erro ao cadastrar: " . $e->getMessage();
	}
	$conn = null;
}
?>