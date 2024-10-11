<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Administrador</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <div class="login-container">
        <div class="tela-login">  
            <h2>Login do Administrador</h2>
            <form action="validar_login_administrador.php" method="post">          
                <div class="mb-3">
                    <label for="emailAdministrador"></label>
                    <input type="text" id="emailAdministrador" name="emailAdministrador" placeholder="Email do Administrador" required>
                </div>
                <br><br>
                <div class="mb-3">
                    <label for="senhaAdministrador"></label>
                    <input type="password" id="senhaAdministrador" name="senhaAdministrador" placeholder="Senha" required>
                </div>
                <br><br>
                <div class="d-grid">
                    <button type="submit">Entrar</button>
                    <br><br>
                      <!-- Botão para Voltar -->
                <a href="index.php">
                    <button type="button">Voltar</button>
                </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
