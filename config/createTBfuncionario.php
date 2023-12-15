<?php

try { 
    include_once "conexao.php";

        //sql para criar a tabela
    $sql = "CREATE TABLE tb_funcionario
    (
        cd_funcionario int PRIMARY KEY AUTO_INCREMENT,
        nm_funcionario VARCHAR(50) NOT NULL,
        cd_cpf CHAR(11) NOT NULL,
        cd_rg CHAR(7) NOT NULL,
        dt_nascimento VARCHAR(11) NOT NULL,
        nm_sexo VARCHAR(10) NOT NULL,
        cd_cep CHAR(8) NOT NULL,
        ds_residencia VARCHAR(100),
        cd_telefone VARCHAR(10),
        cd_celular VARCHAR(14), 
        nm_email VARCHAR(50),
        ds_imagem VARCHAR(100)
    ) engine InnoDB";

    $conn->exec($sql);
    echo "Tabela Funcionário Criada com sucesso";
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;

?>