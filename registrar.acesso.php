<?php

require('check.php');
require('conexao.php'); // Arquivo de conexão com o banco

date_default_timezone_set('America/Sao_Paulo');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_visitante = $_POST['id_visitante'];
    $acao = $_POST['acao']; // 'entrada' ou 'saida'
    $data_acesso = date("Y-m-d"); // Data atual
    $hora_atual = date("Y-m-d H:i:s"); // Data e hora atual

    if ($acao == 'entrada') {
        // Registrar entrada do visitante
        $sql = "INSERT INTO registrosdeacesso (id_visitante, data_acesso, hora_entrada, tipo_acesso) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $tipo_acesso = 'entrada';
        $stmt->bind_param("isss", $id_visitante, $data_acesso, $hora_atual, $tipo_acesso);

    } elseif ($acao == 'saida') {
        // Atualizar o registro para definir a hora de saída do visitante
        $sql = "UPDATE registrosdeacesso SET hora_saida = ?, tipo_acesso = ? WHERE id_visitante = ? AND data_acesso = ? AND tipo_acesso = 'entrada' AND hora_saida IS NULL";
        $stmt = $conn->prepare($sql);
        $tipo_acesso = 'saida';
        $stmt->bind_param("ssis", $hora_atual, $tipo_acesso, $id_visitante, $data_acesso);
    }

    if ($stmt->execute()) {
        // Redirecionar para evitar reenvio
        header("Location: sucesso.php");
        exit;
    } else {
        echo "Erro ao registrar acesso: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
<button type="button" onclick="window.history.back();">Voltar</button>
</body>
</html>