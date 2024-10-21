<?php
// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexão com o banco de dados ----------------- Lembrando que na etec é locahost:3308 e senha etec2024
    $servername = "localhost:3308 "; // Endereço do servidor
    $username = "root"; // Nome de usuário do banco de dados
    $password = "etec2024"; // Senha do banco de dados
    $dbname = "controleacesso_sql"; // Nome do banco de dados

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
            background: #f0f0f0;
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
        <form action="" method="POST">
            <fieldset>
                <legend><b>Cadastro de Novo Usuário</b></legend>
                
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome Completo</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="labelInput">CPF</label>
                </div>
                <div class="inputBox">
                    <input type="email" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <div class="inputBox">
                    <input type="date" name="data_nascimento" id="data_nascimento" class="inputUser" required>
                    <label for="data_nascimento" class="labelInput">Data de Nascimento</label>
                </div>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <p>Nível de Acesso:</p>
                <select name="nivel_acesso" id="nivel_acesso" required>
                    <option value="porteiro">Porteiro</option>
                    <option value="administrador">Administrador</option>
                </select>
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
