<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('DESCONECTADO COM SUCESSO');</script>";

header( "refresh:0;url=index.php" );
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sair</title>
</head>
<body>
</body>
</html>