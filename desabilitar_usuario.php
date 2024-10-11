<?php
require('conexao.php'); // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $acao = $_POST['acao'];

    // Verifica se a ação é desabilitar ou ativar
    if ($acao == 'desabilitar') {
        $novo_status = 'desabilitado';
    } else {
        $novo_status = 'ativo';
    }

    // Atualiza o status do usuário no banco de dados
    $sql = "UPDATE usuarios SET status = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $novo_status, $id_usuario);

    if ($stmt->execute()) {
        header("Location: gerenciar_usuarios.php?sucesso=true");
        exit;
    } else {
        echo "Erro ao atualizar status: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
