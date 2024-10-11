<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Controle de Acesso</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">   
</head>
<body>
    <div class="login-container">
        <div class="tela-login">  
            <h2>Controle de Acesso</h2>
            <form action="login.php" method="post">          
                <div class="mb-3">
                    <label for="nomeUsuario"></label>
                    <input type="text" id="nomeUsuario" name="nomeUsuario" placeholder="Nome de Usuario" required>
                </div>
                <br><br>
                <div class="mb-3">
                    <label for="senhaUsuario"></label>
                    <input type="password" id="senhaUsuario" name="senhaUsuario" placeholder="Senha" required>
                </div>
                <br><br>
                <div class="d-grid">
                    <button type="submit">Entrar</button>
                </div>
            </form>

            <!-- Opção de Novo Cadastro -->
            <div class="novo-cadastro">
                <p>Ainda não tem uma conta?</p>
                <a href="novo.cadastro.php">Novo Cadastro</a>
                <a href="login_administrador.php">Admistrativo</a>
            </div>
        </div>
    </div>
</body>
</html>
