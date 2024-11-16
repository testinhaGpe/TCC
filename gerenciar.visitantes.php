<?php
require('conexao.php'); // Arquivo de conexão com o banco de dados

// Consulta para obter todos os visitantes
$sql = "SELECT v.id_visitante, v.nome, v.documento, v.telefone, u.nome AS usuario_responsavel
        FROM visitantes v
        LEFT JOIN usuarios u ON v.id_usuario = u.id_usuario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Visitantes</title>
    <!-- Link para o Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Alinhamento dos botões */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Cor azul personalizada para cabeçalhos */
        .table thead th {
            background-color: #4a90e2;
            color: white;
        }

        /* Remover margens desnecessárias */
        .btn {
            margin: 0;
        }
        h2 {
            font-weight: bold; /* Tornar o texto em negrito */
            color: #333; /* Cor mais sóbria */
            font-size: 30px; /* Tamanho de fonte maior */
            text-align: center; /* Alinhar o texto ao centro */
            color: #4a90e2;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="action-buttons">
            <!-- Botão de Voltar para o Dashboard -->
            <a href="dashboard.adm.php" class="btn btn-secondary">Voltar</a>

            <!-- Formulário de Pesquisa -->
            <form class="form-inline" method="GET" action="">
                <input type="text" name="search" class="form-control mr-2" placeholder="Buscar por nome ou documento">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>

        <h2 class="text-center mb-4">Gerenciar Visitantes</h2>

        <!-- Tabela de Visitantes -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['documento']; ?></td>
                            <td><?php echo $row['telefone'] ?: 'N/A'; ?></td>
                            <td>
                                <!-- Botões de Ação -->
                                <a href="editar_visitante.php?id=<?php echo $row['id_visitante']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="excluir_visitante.php?id=<?php echo $row['id_visitante']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum visitante encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS e dependências (jQuery e Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Fechar a conexão
$conn->close();
?>
