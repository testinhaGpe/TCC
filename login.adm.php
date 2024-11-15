<?php
require('conexao.php'); // Arquivo de conexão com o banco de dados
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
        header("Location: dashboard.adm.php"); // Redireciona para o dashboard de administrador
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
    <link rel="stylesheet" type="text/css" href="css/login.css"> <!-- Usando o mesmo CSS de login -->
</head>
<body>
    <div class="login-container">
        <div class="tela-login">  
            <h2>Login de Administrador</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>
                <button type="submit">Entrar</button>
            </form>

            <!-- Opção de Novo Cadastro -->
                <!--<div class="novo-cadastro">
                <a href="cadastro_admin.php">Novo Cadastro de Administrador</a> -->
                <p><a href="index.php">Voltar</a></p>
            </div>
        </div>
    </div>

    <?php if (!empty($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>
