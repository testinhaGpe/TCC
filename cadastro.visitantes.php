<?php 
require('check.php'); 
// Conexão com o banco de dados

require('conexao.php'); // Conexão com o banco de dados


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
    <link rel="stylesheet" type="text/css" href="css/formulario.css">     
</head>
<body class="body-cadastro">
    <div class="box">
        <form action="" method="POST">
            <fieldset>
                <legend><b>Cadastro do Visitante</b></legend>
                
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome Completo</label>
                </div>

                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="labelInput">CPF</label>
                </div>

                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>

                <p>Gênero:</p>
                <div class="radioGroup">
                    <input type="radio" id="feminino" name="genero" value="feminino" required>
                    <label for="feminino">Feminino</label>
                </div>
                
                <div class="radioGroup">
                    <input type="radio" id="masculino" name="genero" value="masculino" required>
                    <label for="masculino">Masculino</label>
                </div>

                <div class="radioGroup">
                    <input type="radio" id="outro" name="genero" value="outro" required>
                    <label for="outro">Outro</label>
                </div>

                <input type="submit" name="submit" id="submit" value="Cadastrar">
                <button type="button" onclick="window.history.back();">Voltar</button>
            </fieldset>   
        </form>
    </div>
</body>
</html>
