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
<meta charset='utf-8'>
<?php
echo "<h1>Excluir Cliente</h1>";

$cod = $_GET['id']; //codigo ou id?

include_once('../../config/conexao.php');

    $select = $conn->prepare("SELECT * from tb_cliente where cd_cliente=$cod");
    $select->execute();
    
    while($row = $select->fetch())
    {
        echo "<p>";
        echo "<br><b>Codigo: </b>".$row['cd_cliente'];
        echo "<br><b>Cliente: </b>".$row['nm_cliente'];
        echo "<br><b>CPF: </b>".$row['cd_cpf'];
        echo "<br><b>RG: </b>".$row['cd_rg'];
        echo "<br><b>Nascimento: </b>".$row['dt_nascimento'];
        echo "<br><b>Sexo: </b>".$row['nm_sexo'];
        echo "<br><b>CEP: </b>".$row['cd_cep'];
        echo "<br><b>Logradouro: </b>".$row['ds_residencia'];
        echo "<br><b>Telefone: </b>".$row['cd_telefone'];
        echo "<br><b>Celular: </b>".$row['cd_celular'];
        echo "<br><b>Email: </b>".$row['nm_email'];
        echo "</p>";
        ?>
        <button onclick="window.location.href='./confirmarExcluir/confirmarExcluirCliente.php?id=<?php echo $row['cd_cliente'];?>'">Excluir</button>
        <button onclick="window.location.href='../consultaCliente.php'">Voltar</button>
        <?php
    }


    ?>