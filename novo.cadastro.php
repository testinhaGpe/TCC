<?php
// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexão com o banco de dados ----------------- Lembrando que na etec é locahost:3308 e senha etec2024
    $servername = "localhost:3308";
    $username = "root";
    $password = "etec2024";
    $dbname = "controleacesso_sql";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Receber dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email']; // Certifique-se de adicionar esse campo no formulário
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha
    $tipo_usuario = $_POST['nivel_acesso']; // 'porteiro' ou 'administrador'

    // Inserir dados na tabela 'usuarios'
    $sql = "INSERT INTO usuarios (nome, cpf, email, data_nascimento, telefone, senha, tipo_usuario) 
            VALUES ('$nome', '$cpf', '$email', '$data_nascimento', '$telefone', '$senha', '$tipo_usuario')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo usuário cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
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
    <link rel="stylesheet" type="text/css" href="estilo.css">    
</head>
<body class="body-cadastro">
    <div class="box">
        <form action="" method="POST">
            <fieldset>
                <legend><b>Cadastro de Novo Usuário</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome Completo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="labelInput">CPF</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="email" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="date" name="data_nascimento" id="data_nascimento" class="inputUser" required>
                    <label for="data_nascimento" class="labelInput">Data de Nascimento</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br><br>
                <p>Nível de Acesso:</p>
                <select name="nivel_acesso" id="nivel_acesso" required>
                    <option value="porteiro">Porteiro</option>
                    <option value="administrador">Administrador</option>
                </select>
                <br><br>
                <input type="submit" name="submit" id="submit" value="Cadastrar">
                <br><br>
                 <!-- Botão para Voltar -->
                <a href="index.php">
                    <button type="button">Voltar</button>
                </a>
            </fieldset>   
        </form>
    </div>
</body>
</html>
