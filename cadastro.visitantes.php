<?php 
require('check.php'); 
// Conexão com o banco de dados ----------------- Lembrando que na etec é localhost:3308 e senha etec2024
$servername = "localhost:3308"; // Ou o IP do servidor do banco de dados
$username = "root"; // Usuário do banco de dados
$password = "etec2024"; // Senha do banco de dados
$dbname = "controleacesso_sql"; // Nome do banco de dados

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

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Visitante</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">    
</head>
<body class="body-cadastro">
    <div class="box">
        <form action="" method="POST">
            <fieldset>
                <legend><b>Cadastro do Visitante</b></legend>
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
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <br><br>
                <p>Gênero:</p>
                <input type="radio" id="feminino" name="genero" value="feminino" required>
                <label for="feminino">Feminino</label>
                <br><br>
                <input type="radio" id="masculino" name="genero" value="masculino" required>
                <label for="masculino">Masculino</label>
                <br><br>
                <input type="radio" id="outro" name="genero" value="outro" required>
                <label for="outro">Outro</label>
                <br><br>
                <input type="submit" name="submit" id="submit">
                <button type="button" onclick="window.history.back();">Voltar</button>
            </fieldset>   
        </form>
    </div>
</body>
</html>
