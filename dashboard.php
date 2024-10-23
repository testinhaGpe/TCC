<?php require('check.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">   
</head>
<body>
    <div class="container">
        <h1>Olá <?php echo $_SESSION['usuario']; ?>, Seja bem-vindo.</h1>

        <!-- Formulário para buscar visitante já cadastrado -->
        <div class="form-container">
            <form action="entrada.ou.saida.php" method="POST">
                <fieldset>
                    <legend><b>Registrar Entrada ou Saída</b></legend>
                    <label for="cpf">Digite o CPF do visitante:</label>
                    <input type="text" name="cpf" id="cpf" required>
                    <button type="submit">Buscar Visitante</button>
                </fieldset>
            </form>
        <br>

        <!-- Botão para cadastrar novos visitantes -->
        <div class="button-container">
            <a href="cadastro.visitantes.php"><button>Cadastrar Novo Visitante</button></a>
        </div>

        <!-- Botões para funcionalidades adicionais -->
        <div class="button-container">
            <a href="relatorios.php"><button>Gerar Relatório</button></a> 
            <br><br>
            <a href="logout.php"><button>Deslogar</button></a>
        </div>
    </div>
</body>
</html>
