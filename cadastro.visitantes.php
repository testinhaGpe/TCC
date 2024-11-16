<?php 
require('check.php'); 
// Conexão com o banco de dados

require('conexao.php'); // Arquivo de conexão com o banco


// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if (isset($_POST['submit'])) {
    // Obter os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $genero = $_POST['genero'];

    // Verificar se o CPF já existe no banco de dados
    $sql_check = "SELECT * FROM visitantes WHERE documento = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $cpf);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // CPF já existe
        echo "<script>
                alert('Erro: CPF já cadastrado!');
                window.location.href = 'cadastro.visitantes.php';
              </script>";
    } else {
        // Preparar o SQL para inserção dos dados
        $sql = "INSERT INTO visitantes (nome, documento, telefone) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $cpf, $telefone);

        // Executar e verificar se foi inserido com sucesso
        if ($stmt->execute()) {
            echo "<script>
                    alert('Cadastro de visitante realizado com sucesso!');
                    window.location.href = 'dashboard.php';
                  </script>";
            exit();
        } else {
            echo "Erro ao cadastrar visitante: " . $stmt->error;
        }

        // Fechar o statement
        $stmt->close();
    }

    // Fechar o statement de verificação
    $stmt_check->close();
}

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Visitante</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilo Customizado -->
    <link rel="stylesheet" href="css/formulario.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Cadastro do Visitante</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite seu nome" required>
                    </div>

                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Digite seu CPF" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" name="telefone" id="telefone" class="form-control" placeholder="Digite seu telefone" required>
                    </div>

                    <div class="mb-3">
                        <p class="form-label">Gênero:</p>
                        <div class="form-check">
                            <input type="radio" id="feminino" name="genero" value="feminino" class="form-check-input" required>
                            <label for="feminino" class="form-check-label">Feminino</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="masculino" name="genero" value="masculino" class="form-check-input" required>
                            <label for="masculino" class="form-check-label">Masculino</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="outro" name="genero" value="outro" class="form-check-input" required>
                            <label for="outro" class="form-check-label">Outro</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" name="submit" class="btn btn-primary">Cadastrar</button>
                        <button type="button" onclick="window.history.back();" class="btn btn-secondary">Voltar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
