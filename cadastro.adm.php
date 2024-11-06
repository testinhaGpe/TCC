<?php
// Conexão com o banco de dados

$servername = "localhost"; // Endereço do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = "psilva09"; // Senha do banco de dados
$dbname = "controleacesso_sql"; // Nome do banco de dados

//Conexão Escola 
$servername = "localhost:3308"; // Endereço do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = "etec2024"; // Senha do banco de dados
$dbname = "controleacesso_sql"; // Nome do banco de dados


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
                header("Location: login.adm.php"); // Redireciona para a tela de login
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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 105vh;
            margin: 0;
        }
        .box {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        form fieldset {
            border: none;
            padding: 0;
        }
        legend {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .inputBox {
            margin-bottom: 15px;
            position: relative;
        }
        .inputBox input,
        select {
            width: 100%;
            padding: 10px;
            background: #f8fafc;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }
        .inputBox input:focus,
        select:focus {
            border-color: #007bff;
        }
        .inputBox label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            background-color: #fff;
            padding: 0 5px;
            color: #666;
            pointer-events: none;
            transition: all 0.3s ease;
        }
        .inputBox input:focus + .labelInput,
        input:not(:placeholder-shown) + .labelInput {
            top: -10px;
            font-size: 12px;
            color: #007bff;
        }
        select {
            margin-bottom: 15px;
        }
        p {
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: bold;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        /* Botão Voltar */
        a button {
            width: 100%;
            padding: 10px;
            background-color: #6c757d;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        a button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body class="body-cadastro">
    <div class="box">
        <form method="POST" action="">
            <fieldset>
                <legend><b>Cadastro de Administrador</b></legend>
                
                <div class="inputBox">
                    <input type="text" id="nome" name="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <div class="inputBox">
                    <input type="email" id="email" name="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <div class="inputBox">
                    <input type="password" id="senha" name="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>

                <input type="submit" name="submit" id="submit" value="Cadastrar">
                <!-- Botão para Voltar -->
                <a href="index.php">
                    <button type="button">Voltar</button>
                </a>
            </fieldset>   
        </form>
    </div>
</body>

</html>
