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
		 
			$select = $conn->prepare("SELECT * FROM tb_produto where cd_produto=$cod");
			$select->execute();
		
			$row = $select->fetch();
			
	 ?>
		<form action="./confirmarAlterar/confirmarAlterarProduto.php" method="POST">

			<div class="container">
				<div class="row">
    				<div class="col">
                    
      			
    				</div>
    				<div class="col">
      					<div class="mb-3">
      						<h1 class="bg-primary text-white">Alterar Produto</h1>
				
							<label for="cname"><b>Código</b></label>
							<input type="text" class="form-control" name="codigo" value="<?php echo $row['cd_produto'];?>" readonly="true">
							
							<label for="cname"><b>Nome</b></label>
							<input type="text" class="form-control" name="nome" value="<?php echo $row['nm_produto'];?>" required>
							
							<label for="cBARRAS"><b>Código de Barras</b></label>
							<input type="text" placeholder="Código de Barras do Produto" class="form-control" name="barras" required value="<?php echo $row['cd_barras'];?>">
							
							<label for="cTIPO"><b>Tipo do Produto</b></label>
							<input type="text" placeholder="Tipo do Produto" class="form-control" name="tipo" value="<?php echo $row['ds_tipo'];?>" required>

							<label for="cPreco"><b>Preço</b></label>
							<input type="text" placeholder="Preço do Produto" class="form-control" name="preco" value="<?php echo $row['vl_preco'];?>" required>
							
							<label for="cNCM"><b>NCM</b></label>
							<input type="text" placeholder="NCM do Produto" id="ncm" class="form-control" name="NCM" value="<?php echo $row['cd_ncm'];?>" required>
							
							<label for="cdesc"><b>Descrição</b></label>
							<input type="text" placeholder="Descrição do Produto" class="form-control" name="descricao" value="<?php echo $row['ds_produto'];?>"  required>

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