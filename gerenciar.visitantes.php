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
</head>
<body>
    <div class="container mt-5">
        <!-- Botão de Voltar para o Dashboard -->
        <div class="mb-4">
            <a href="dashboard.adm.php" class="btn btn-secondary">Voltar</a>
        </div>

        <h2 class="text-center mb-4">Gerenciar Visitantes</h2>
        
        <!-- Formulário de Pesquisa -->
        <form class="form-inline mb-4" method="GET" action="">
            <input type="text" name="search" class="form-control mr-2" placeholder="Buscar por nome ou documento">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <!-- Tabela de Visitantes -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th>Telefone</th>
                    <th>Responsável</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_visitante']; ?></td>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['documento']; ?></td>
                            <td><?php echo $row['telefone'] ?: 'N/A'; ?></td>
                            <td><?php echo $row['usuario_responsavel'] ?: 'Não atribuído'; ?></td>
                            <td>
                                <!-- Botões de Ação -->
                                <a href="editar_visitante.php?id=<?php echo $row['id_visitante']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="excluir_visitante.php?id=<?php echo $row['id_visitante']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum visitante encontrado</td>
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
