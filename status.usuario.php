<?php
require('conexao.php'); // Conexão com o banco de dados

// Verificar se o ID do usuário foi passado
if (isset($_POST['id_usuario']) && isset($_POST['acao'])) {
    $id_usuario = $_POST['id_usuario'];
    $status = ($_POST['acao'] === 'desabilitar') ? 'inativo' : 'ativo';

    // Atualizar o status do usuário no banco de dados
    $sql = "UPDATE usuarios SET status = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id_usuario);

    try {
        $stmt->execute();
        // Redirecionar com mensagem de sucesso
        header("Location: desabilitar.usuario.php?mensagem=sucesso");
    } catch (mysqli_sql_exception $e) {
        echo "Erro ao atualizar o status: " . $e->getMessage();
    }

    $stmt->close();
} else {
    echo "Dados insuficientes para alterar o status do usuário.";
}

$conn->close();
