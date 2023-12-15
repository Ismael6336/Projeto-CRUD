<?php

try { 
    include_once "conexao.php";

    //sql para criar a tabela
    $sql = "CREATE TABLE tb_usuario
    (
        cd_usuario int PRIMARY KEY AUTO_INCREMENT,
        cd_cpf CHAR(11) NOT NULL,
        nm_usuario CHAR(100) NOT NULL,
        cd_senha VARCHAR(50) NOT NULL,
        cd_funcionario int,
        ds_imagem VARCHAR(100),
        cd_nivel char(1),
        constraint fk_usuario_funcionario 
            FOREIGN KEY(cd_funcionario)
                references tb_funcionario(cd_funcionario)
                ) engine InnoDB";

    //use exec() porque não são retornados resultados
    $conn->exec($sql);
    echo "Tabela Usuario Criada com sucesso";
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;


?>