<?php require('check.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f8f9fa;
    }
    .navbar {
        background-color: #2E2EFE;
    }
    .navbar-brand {
        color: white;
    }
    .card-header {
        background-color: #2E2EFE;
        color: white;
    }
    .card-container {
        max-height: 1px; /* Definir altura máxima */
        overflow-y: auto; /* Habilitar rolagem se o conteúdo exceder a altura máxima */
    }
    .logout-btn {
        color: white;
        background-color: #DC143C;
        border: none;
        padding: 10px 20px; /* Aumenta o padding horizontal */
        border-radius: 25px; /* Arredonda as bordas do botão */
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s; /* Adiciona transições suaves */
    }
    .logout-btn:hover {
        background-color: #c82333; /* Tom de vermelho mais escuro no hover */
        transform: scale(1.05); /* Efeito de aumentar levemente ao passar o mouse */
    }
    .btn-custom {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px; /* Arredonda as bordas dos botões personalizados */
    }
    .btn-custom:hover {
        background-color: #0056b3;
    }
</style>

</head>
<body>

   <!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Dashboard</a>
    <div class="ml-auto">
        <a href="logout.php" class="logout-link">
            <button class="logout-btn">Deslogar</button>
        </a>
    </div>
</nav>

<!-- Conteúdo Principal -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <!-- Mensagem de boas-vindas -->
        <div class="col-12 text-center">
            <h1>Olá, <?php echo $_SESSION['usuario']; ?>! Seja bem-vindo.</h1>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Formulário de busca por visitante -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    Registrar Entrada ou Saída
                </div>
                <div class="card-body">
                    <form action="entrada.ou.saida.php" method="POST">
                        <div class="form-group">
                            <label for="cpf">Digite o CPF do visitante:</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" required>
                        </div>
                        <button type="submit" class="btn btn-custom btn-block">Buscar Visitante</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cards de funcionalidades adicionais, lado a lado -->
        <div class="col-md-8">
            <div class="row">
                <!-- Card de Cadastrar Novo Visitante -->
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header text-center">Sem Texto ainda preciso Resolver</div>
                        <div class="card-body text-center">
                            <a href="cadastro.visitantes.php" class="btn btn-custom btn-block">Cadastrar Novo Visitante</a>
                        </div>
                    </div>
                </div>

                <!-- Card de Gerar Relatório -->
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header text-center">Sem Texto ainda preciso Resolver</div>
                        <div class="card-body text-center">
                            <a href="relatorios.php" class="btn btn-custom btn-block">Gerar Relatório</a>
                        </div>
                    </div>
                </div>
                <!-- Card de Deslogar DESATIVADO -->
                <!-- <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">Deslogar</div>
                        <div class="card-body text-center">
                            <a href="logout.php" class="btn btn-custom btn-block">Deslogar</a>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
