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
	    <script src="../../forms/js/buscaCep.js"> </script>
		<script src="../../forms/js/validaCPF.js"> </script>
		<title>SISTEMA COMERCIAL - ALTERAR FUNCIONARIO</title>
	</head>
	<body>

	<?php

		$cod = $_GET['id'];
		
		include_once('../../config/conexao.php');
		 
			$select = $conn->prepare("SELECT * FROM tb_funcionario where cd_funcionario=$cod");
			$select->execute();
		
			$row = $select->fetch();
			
	 ?>
		<form action="./confirmarAlterar/confirmarAlterarFuncionario.php" method="POST">

			<div class="container">
				<div class="row">
    				<div class="col">
                    
      			
    				</div>
    				<div class="col">
      					<div class="mb-3">
      						<h1 class="bg-primary text-white">Alterar Funcionario</h1>
				
							<label for="cname"><b>Código</b></label>
							<input type="text" class="form-control" name="codigo" value="<?php echo $row['cd_funcionario'];?>" readonly="true">
							
							<label for="cname"><b>Nome</b></label>
							<input type="text" class="form-control" name="nome" value="<?php echo $row['nm_funcionario'];?>" required>
							
							<label for="cCPF"><b>CPF</b></label>
							<input type="text" placeholder="CPF do Funcionario" class="form-control" name="cpf" required maxlength="14" value="<?php echo $row['cd_cpf'];?>"
							onkeypress='return event.charCode >= 48 && event.charCode <= 57'  
							onblur="TestaCPF(this.value);">
							
							<label for="cRG"><b>RG</b></label>
							<input type="text" placeholder="RG do Funcionario" class="form-control" name="RG" value="<?php echo $row['cd_rg'];?>" required>
							
							<label for="cCEP"><b>CEP</b></label>
							<input type="text" placeholder="CEP do Funcionario" id="cep" class="form-control" name="cep" value="<?php echo $row['cd_cep'];?>"
								   onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
							<input type="button" name="buscaCep" value="Buscar" onclick="pesquisacep(cep.value);">
							<br><br>
							
							<label for="cRua"><b>Rua</b></label>
							<input type="text" class="form-control" name="rua" id="rua">
							
							<label for="cNumero"><b>Numero</b></label>
							<input type="text" class="form-control" name="numero" id="numero" value="<?php echo $row['ds_residencia'];?>" >
							
							<label for="cBairro"><b>Bairro</b></label>
							<input type="text" class="form-control" name="bairro" id="bairro">
							
							<label for="cCidade"><b>Cidade</b></label>
							<input type="text" class="form-control" name="cidade" id="cidade">
							
							<label for="cUF"><b>Estado</b></label>
							<input type="text" class="form-control" name="uf" id="uf">
							
							<label for="cCel"><b>Telefone</b></label>
							<input type="text" placeholder="Telefone do Funcionario" class="form-control" name="telefone" value="<?php echo $row['cd_telefone'];?>"  required>

							<label for="cCel"><b>Celular</b></label>
							<input type="text" placeholder="Celular do Funcionario" class="form-control" name="celular" value="<?php echo $row['cd_celular'];?>"  required>
							
							<label for="cEmail"><b>Email</b></label>
							<input type="text" placeholder="e-mail do Funcionario" class="form-control" name="email" value="<?php echo $row['nm_email'];?>"  required>
							<br>	
							<div class="text-center">
								<button type="submit" class="btn btn-primary">Atualizar</button>
								<button type="reset" class="btn btn-success" onclick="javascript: location.href='../consultaFuncionario.php'">Voltar</button>
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