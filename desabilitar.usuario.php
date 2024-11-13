<?php
require('conexao.php'); // Conexão com o banco de dados

// Consulta para listar todos os usuários
$sql = "SELECT id_usuario, nome, cpf, email, status FROM usuarios WHERE tipo_usuario = 'porteiro'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">

    <title>Gerenciar Usuários</title>
</head>
<body>
    <h1>Gerenciar Porteiros</h1>

    <!-- Mensagem de sucesso -->
    <?php if (isset($_GET['mensagem']) && $_GET['mensagem'] === 'sucesso'): ?>
        <p style="color: green;">Status do usuário atualizado com sucesso!</p>
    <?php endif; ?>
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id_usuario'] . "</td>
                            <td>" . $row['nome'] . "</td>
                            <td>" . $row['cpf'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['status'] . "</td>
                            <td>
                                <form action='status.usuario.php' method='POST'>
                                    <input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>
                                    <button type='submit' name='acao' value='" . ($row['status'] == 'ativo' ? 'desabilitar' : 'ativar') . "'>
                                        " . ($row['status'] == 'ativo' ? 'Desabilitar' : 'Ativar') . "
                                    </button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum usuário encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br><br>
    <!-- Botão para voltar ao Dashboard -->
    <a href="dashboard.php"><button>Voltar</button></a>
</body>
</html>
