<?php require('check.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">    
</head>
<body>
    <div>
        <div>
            <p>Olá <?php echo $_SESSION['usuario']; ?>, seja bem-vindo.</p>
        </div>

        <!-- Formulário para buscar visitante já cadastrado -->
        <div>
            <form action="entrada_ou_saida.php" method="POST">
                <fieldset>
                    <legend><b>Registrar Entrada ou Saída</b></legend>
                    <label for="cpf">Digite o CPF do visitante:</label>
                    <input type="text" name="cpf" id="cpf" required>
                    <button type="submit">Buscar Visitante</button>
                </fieldset>
            </form>
        </div>
        <br><br><br>   
        
        <!-- Botão para cadastrar novos visitantes -->
        <div>
            <a href="cadastro.visitantes.php"><button>Cadastrar Novo Visitante</button></a>
        </div>

        <!-- Botões para funcionalidades adicionais -->
        <div>
            <a href="relatorios.php"><button>Gerar Relatório</button></a> <!-- Novo botão de relatórios -->
            <a href="logout.php"><button>Deslogar</button></a>
        </div>
    </div>
</body>
</html>
