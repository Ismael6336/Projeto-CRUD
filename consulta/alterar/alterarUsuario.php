<?php
session_start();
include_once('../../config/conexao.php');
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
    window.location.href='../../index.php';
  </script>";	
}
?>
<html>
	<head>
		<meta charset="utf-8">
	    <meta name="vRGwport" content="width=device-width, initial-scale=1">
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	    <script src="js/buscaNCM.js"> </script>
		<script src="js/validaCPF.js"> </script>
		<title>SISTEMA COMERCIAL - ALTERAR USUARIO</title>
	</head>
	<body>

	<?php

		$cod = $_GET['id'];
		
		include_once('../../config/conexao.php');
		 
			$select = $conn->prepare("SELECT * FROM tb_usuario where cd_usuario=$cod");
			$select->execute();
		
			$row = $select->fetch();
			
	 ?>
		<form action="./confirmarAlterar/confirmarAlterarUsuario.php" method="POST">

			<div class="container">
				<div class="row">
    				<div class="col">
                    
      			
    				</div>
    				<div class="col">
      					<div class="mb-3">
      						<h1 class="bg-primary text-white">Alterar Usuario</h1>
				
							<label for="cname"><b>Código</b></label>
							<input type="text" class="form-control" name="codigo" value="<?php echo $row['cd_usuario'];?>" readonly="true">
							
							<label for="cname"><b>Nome</b></label>
							<input type="text" class="form-control" name="nome" value="<?php echo $row['cd_cpf'];?>" required>
							
							<label for="cSenha"><b>Senha</b></label>
							<input type="text" placeholder="Senha" class="form-control" name="senha" required value="<?php echo $row['cd_senha'];?>">
							
							<br>	
							<div class="text-center">
								<button type="submit" class="btn btn-primary">Atualizar</button>
								<button type="reset" class="btn btn-success" onclick="javascript: location.href='consultaProduto.php'">Voltar</button>
							</div>
						</div>
  					</div>
  					<div class="col">
      			
    				</div>
				</div>
			</div>
		</form>
	</body>
</html>