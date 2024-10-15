<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "psilva09";
$dbname = "controleacesso_sql";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validar se os campos obrigatórios estão preenchidos
    if (!empty($nome) && !empty($email) && !empty($senha)) {
        // Verificar se o e-mail já existe no banco de dados
        $sql_verifica = "SELECT * FROM administradores WHERE email = ?";
        $stmt_verifica = $conn->prepare($sql_verifica);
        $stmt_verifica->bind_param("s", $email);
        $stmt_verifica->execute();
        $result_verifica = $stmt_verifica->get_result();

        if ($result_verifica->num_rows > 0) {
            // Se o e-mail já existir, exibir uma mensagem de erro
            echo "Erro: Este e-mail já está cadastrado. Por favor, escolha outro.";
        } else {
            // Hash da senha para segurança
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            // Consulta para inserir novo administrador
            $sql = "INSERT INTO administradores (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nome, $email, $senha_hash);

            if ($stmt->execute()) {
                echo "Administrador cadastrado com sucesso!";
                header("Location: login_administrador.php"); // Redireciona para a tela de login
                exit;
            } else {
                echo "Erro ao cadastrar administrador: " . $stmt->error;
            }
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Administrador</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">   
</head>
<body>
    <h2>Cadastro de Administrador</h2>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
