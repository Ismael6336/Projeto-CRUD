<?php
session_start();
include_once('../config/conexao.php');
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
    window.location.href='../index.php';
  </script>";	
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA COMERCIAL - CONSULTA FUNCIONARIO</title>
</head>
<body>
<?php

        include_once('../config/conexao.php');
        try
        {
            $select = $conn ->prepare('SELECT * FROM tb_funcionario');
            $select->execute();

            while($row = $select->fetch())
            {
                    echo "<p>";
                    echo "<br><img src='".$row['ds_imagem']."' width=80px;>";
                    echo "<br><b>Código: </b>".$row['cd_funcionario'];
                    echo "<br><b>Nome do Funcionário: </b>".$row['nm_funcionario'];
                    echo "<br><b>CPF do Funcionário: </b>".$row['cd_cpf'];
                    echo "<br><b>RG do Funcionário: </b>".$row['cd_rg'];
                    echo "<br><b>Data de Nascimento: </b>".$row['dt_nascimento'];
                    echo "<br><b>Sexo: </b>".$row['nm_sexo'];
                    echo "<br><b>CEP: </b>".$row['cd_cep'];
                    echo "<br><b>Logradouro: </b>".$row['ds_residencia'];
                    echo "<br><b>Telefone: </b>".$row['cd_telefone'];
                    echo "<br><b>Celular: </b>".$row['cd_celular'];
                    echo "<br><b>Email: </b>".$row['nm_email'];
                    echo "</p>";
                    ?>

                    <input type="button" name="Alterar" value="Alterar" class="btn btn-primary" onclick="javascript: location.href='./alterar/alterarFuncionario.php?id=<?php echo $row['cd_funcionario']; ?>' "/>

                    <input type="button" name="Excluir" value="Excluir" class="btn btn-primary" onclick="javascript: location.href='./excluir/excluirFuncionario.php?id=<?php echo $row['cd_funcionario']; ?>' "/>

                    <?php
            }
        }
        catch(PDOException $e)
        {
                echo 'ERROR: ' . $e->getMessage();
        }
?>
</body>
</html>