<?php
require('conexao.php'); // Conexão com o banco de dados

// Verificar se o ID foi enviado pela URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do visitante não fornecido.");
}

// Consultar dados do visitante
$sql = "SELECT id_visitante, nome, telefone, documento FROM visitantes WHERE id_visitante = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Visitante não encontrado.");
}

$visitante = $result->fetch_assoc();

// Atualizar os dados no banco de dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $documento = $_POST['documento'];

    $sql = "UPDATE visitantes SET nome = ?, telefone = ?, documento = ? WHERE id_visitante = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $telefone, $documento, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Dados atualizados com sucesso!'); window.location.href = 'gerenciar.visitantes.php';</script>";
    } else {
        echo "Erro ao atualizar os dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Visitante</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            font-weight: bold;
            color: #4a90e2;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-back {
            display: block;
            margin: 10px auto;
        }

        .btn {
            font-size: 16px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input {
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .btn-block {
            background-color: #4a90e2;
            color: white;
            font-weight: bold;
        }

        .btn-block:hover {
            background-color: #357abd;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <h2>Editar Visitante</h2>
        <form method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?= htmlspecialchars($visitante['nome']) ?>" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-control" value="<?= htmlspecialchars($visitante['telefone']) ?>" required>
            </div>
            <div class="form-group">
                <label for="documento">CPF (Documento):</label>
                <input type="text" id="documento" name="documento" class="form-control" value="<?= htmlspecialchars($visitante['documento']) ?>" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Salvar Alterações</button>
        </form>
        <a href="gerenciar.visitantes.php" class="btn btn-secondary btn-back">Voltar</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
