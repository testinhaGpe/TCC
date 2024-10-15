<?php
// Conexão com o banco de dados
$servername = "localhost"; // Endereço do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = "psilva09"; // Senha do banco de dados
$dbname = "controleacesso_sql"; // Nome do banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se o email e senha correspondem a um administrador
    $sql = "SELECT * FROM administradores WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($senha, $admin['senha'])) {
        // Sessão iniciada com sucesso
        session_start();
        $_SESSION['id_administrador'] = $admin['id_administrador'];
        header("Location: dashboard_admin.php"); // Redireciona para o dashboard de administrador
        exit;
    } else {
        $error = "Email ou senha incorretos";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Administrador</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">   
</head>
<body>
    <h2>Login de Administrador</h2>
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <button type="submit">Entrar</button>
    </form>

    <!-- Botão para novo cadastro de administrador -->
    <a href="cadastro_admin.php"><button>Novo Cadastro</button></a>
    <a href="index.php"><button>Voltar</button></a>

    <?php if (!empty($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>
