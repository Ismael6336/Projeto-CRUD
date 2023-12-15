<?php

try { 
    include_once "conexao.php";

    //sql para criar a tabela
    $sql = "CREATE TABLE tb_produto
    (
        cd_produto int PRIMARY KEY AUTO_INCREMENT,
        nm_produto VARCHAR(50) NOT NULL,
        cd_barras VARCHAR(43) NOT NULL,
        ds_tipo VARCHAR(50) NOT NULL,
        cd_ncm CHAR(8) NOT NULL,
        vl_preco float(7,2) NOT NULL,
        vl_custo float(7,2) NOT NULL,
        ds_produto VARCHAR(200) NOT NULL,
        ds_imagem VARCHAR(100)
    ) engine InnoDB";

    //use exec() porque não são retornados resultados
    $conn->exec($sql);
    echo "Tabela Produto Criada com sucesso";
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;


?>