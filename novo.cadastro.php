<?php
// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('conexao.php'); // Conexão com o banco de dados
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Receber dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo_usuario = $_POST['nivel_acesso'];

    // Verificar duplicidade de CPF ou e-mail
    $sql_check = "SELECT * FROM usuarios WHERE cpf = '$cpf' OR email = '$email'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        // Exibir mensagem de erro se CPF ou e-mail já existirem
        $erro = "Erro: CPF ou e-mail já cadastrado!";
    } else {
        // Inserir dados na tabela 'usuarios'
        $sql = "INSERT INTO usuarios (nome, cpf, email, data_nascimento, telefone, senha, tipo_usuario) 
                VALUES ('$nome', '$cpf', '$email', '$data_nascimento', '$telefone', '$senha', '$tipo_usuario')";

        if ($conn->query($sql) === TRUE) {
            // Redirecionar para index.php após o cadastro
            header("Location: index.php");
            exit();
        } else {
            $erro = "Erro ao cadastrar usuário: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <!-- Link do Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        .form-container legend {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="" method="POST">
            <fieldset>
                <legend>Cadastro de Novo Usuário</legend>

                <!-- Exibir mensagem de erro, se houver -->
                <?php if (!empty($erro)): ?>
                    <p class="error-message"><?= $erro; ?></p>
                <?php endif; ?>
                
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" name="nome" id="nome" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nivel_acesso" class="form-label">Nível de Acesso</label>
                    <select name="nivel_acesso" id="nivel_acesso" class="form-select" required>
                        <option value="porteiro">Porteiro</option>
                        <!-- <option value="administrador">Administrador</option> -->
                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="index.php" class="btn btn-secondary">Voltar</a>
                </div>
            </fieldset>
        </form>
    </div>
    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
