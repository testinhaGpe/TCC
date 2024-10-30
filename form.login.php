<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Controle de Acesso</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">   
</head>
<body>
     <!-- Imagem do Logo -->
            <div class="logo">
            <img src="img/logo.png" alt="Concierge - Controle o seu Acesso">
            </div><div class="login-container">
        
        <div class="tela-login">  
            <h2>Controle de Visitante</h2>
            <form action="login.php" method="post">          
                <div class="form-group">
                    <label for="nomeUsuario">Nome de Usuário</label>
                    <input type="text" id="nomeUsuario" name="nomeUsuario" placeholder="Digite seu nome de usuário" required>
                </div>
                <div class="form-group">
                    <label for="senhaUsuario">Senha</label>
                    <input type="password" id="senhaUsuario" name="senhaUsuario" placeholder="Digite sua senha" required>
                </div>
                <button type="submit">Entrar</button>
            </form>

            <!-- Opção de Novo Cadastro -->
            <div class="novo-cadastro">
                <p>Ainda não tem uma conta?</p>
                <a href="novo.cadastro.php">Novo Cadastro</a>
            <!-- Opção para criar botão de administrador na tela principal de Login -->   
            <!-- <p><a href="login_administrador.php">Área Administrativa</a></p> --> 
            </div>
        </div>
    </div>
</body>
</html>
