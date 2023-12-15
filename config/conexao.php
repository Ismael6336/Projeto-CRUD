<?php
$servername = "localhost:3306"; // Porta do Mysql disponivel na máquina local;
$username = "root"; // Usuário do SGBD;
$password = "usbw"; // Senha do SGBD;

try{
    $conn = new PDO("mysql:host=$servername;dbname=sistema",
                    $username,
                    $password); // Objeto Conn que está conectado ao Banco de dados
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected Successfully ";
}   catch(PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}
?>