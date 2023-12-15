<?php

try { 
    include_once "conexao.php";

        //sql para criar a tabela
    $sql = "CREATE TABLE tb_fornecedor
    (
        cd_fornecedor int PRIMARY KEY AUTO_INCREMENT,
        cd_cnpj CHAR(14) NOT NULL,
        cd_ie CHAR(9) NOT NULL,
        nm_razaosocial VARCHAR(100) NOT NULL,
        nm_fantasia VARCHAR(100) NOT NULL,
        cd_cep CHAR(8) NOT NULL,
        ds_residencia VARCHAR(100),
        cd_telefone VARCHAR(10),
        cd_celular VARCHAR(14), 
        nm_email VARCHAR(50),
        ds_imagem VARCHAR(100)
    ) engine InnoDB";

    $conn->exec($sql);
    echo "Tabela Fornecedor Criada com sucesso";
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;


?>