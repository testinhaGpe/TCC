<?php require('check.php');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
</head>
<link rel="stylesheet" type="text/css" href="estilo.css">    
<body>
    <div>
        <div>
            <p>Olá <?php echo $_SESSION['usuario']; ?> seja bem vindo.</p>
        </div>
        <div>
            <a href="cadastro.visitantes.php"><button>Cadastrar</button></a>
        </div>
        <div>
            <a href="entrada.php"><button>Entrar</button>
        </div>
        <div>
            <a href="saida.php"><button>Sair</button></a>
        </div>
        <div>
            <a href="logout.php"><button>Deslogar</button></a>
        </div>
    </div>
</body>
</html>