<?php

// Incluir o arquivo de conexão
include 'conexao.php';

// Verificar se a conexão foi bem-sucedida e começar a trabalhar com o banco de dados
if ($conn) {
    echo "Estamos conectados ao banco de dados.";
    // Aqui você pode realizar suas operações como consultas e inserções
} else {
    echo "Falha ao conectar.";
}

session_start();
if (isset($_SESSION['idUsuario'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
</head>
<body>
    <?php include('form.login.php'); ?>
</body>
</html>