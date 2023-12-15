<?php
$servername = "localhost:3306"; // Porta do Mysql disponivel na máquina local;
$username = "root"; // Usuário do SGBD;
$password = "usbw"; // Senha do SGBD;

try{
    $conn = new PDO("mysql:host=$servername;",
                    $username,
                    $password); // Objeto Conn que está conectado ao Banco de dados
    include_once "conexao.php";

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, 
                        PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully ";

    $sql = "CREATE DATABASE sistema";
    // use exec() because no results returned
    $conn->exec($sql);
    echo "Database created successfully<br> ";
    }   catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
?>