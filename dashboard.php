<?php require('check.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Controle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilo geral */
        body {
            background-color: #e9ecef;
            font-family: Arial, sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: #1f2d3d;
        }
        .navbar-brand {
            color: #f8f9fa;
            font-weight: bold;
        }
        .navbar-brand:hover {
            color: #adb5bd;
        }

        /* Botão de Logout */
        .logout-btn {
            color: white;
            background-color: #d9534f;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #c9302c;
        }

        /* Estilo dos Cards */
        .card {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.02);
        }

        .card-header {
            background-color: #4a90e2;
            color: white;
            text-align: center;
            font-weight: bold;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        /* Botões Personalizados */
        .btn-custom {
            background-color: white;     /* Fundo branco */
            color: #007bff;              /* Texto azul */
            border: 2px solid #007bff;   /* Borda azul */
            border-radius: 5px;
            padding: 10px;
            font-weight: bold;
            margin-top: auto;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #429dff;   /* Fundo azul ao passar o mouse */
            color: white;                /* Texto branco ao passar o mouse */
        }

        /* Título Principal */
        h1 {
            color: #343a40;
            font-size: 1.8em;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Controle de Portaria</a>
    <div class="ml-auto">
        <a href="logout.php" class="logout-link">
            <button class="logout-btn">Deslogar</button>
        </a>
    </div>
</nav>

<!-- Conteúdo Principal -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h1>Bem-vindo, <?php echo $_SESSION['usuario']; ?>! Pronto para o trabalho Vagabundo?</h1>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Registrar Entrada ou Saída</div>
                <div class="card-body" style="min-height: 400px;">
                    <form action="entrada.ou.saida.php" method="POST">
                        <div class="form-group">
                            <label for="cpf">Digite o CPF do visitante:</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" required>
                        </div>
                        <button type="submit" class="btn btn-custom btn-block">Buscar Visitante</button>
                    </form>
                        <!-- Logo abaixo do botão -->
                        <div class="text-center mt-3">
                            <img src="img/logo.png" alt="Logo" class="img-fluid" style="max-width: 250px;">
                        </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">Cadastrar Novo Visitante</div>
                        <div class="card-body">
                            <a href="cadastro.visitantes.php" class="btn btn-custom btn-block">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">Entrada e Saida Relatório</div>
                        <div class="card-body">
                            <a href="relatorios.php" class="btn btn-custom btn-block">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">Relatório Semanal</div>
                        <div class="card-body">
                            <a href="relatorio.semanal.phps.php" class="btn btn-custom btn-block">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header"> Relatório de Visitantes Ativos</div>
                        <div class="card-body">
                            <a href="relatorio.de.visitantes.ativo.php" class="btn btn-custom btn-block">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header"> Relatório de Tempo de Permanência de Visitantes</div>
                        <div class="card-body">
                            <a href="relatorio.tempo.php" class="btn btn-custom btn-block">Acessar</a>
                        </div>
                    </div>
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
