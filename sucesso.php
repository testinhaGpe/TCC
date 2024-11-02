<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso</title>
    <style>
        /* Estilo para centralizar a mensagem e o botão */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
        }
        .message-box {
            border: 1px solid #28a745;
            padding: 20px;
            border-radius: 5px;
            background-color: #e9ffe9;
        }
        h1 {
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h1>Acesso registrado com sucesso!</h1>
        <p>Você será redirecionado para a página inicial em breve.</p>
        <button type="button" onclick="window.location.href='index.php';">Voltar para a página inicial</button>
    </div>

    <script>
        // Função para redirecionar após 5 segundos
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 5000); // 5000 milissegundos = 5 segundos
    </script>
</body>
</html>
